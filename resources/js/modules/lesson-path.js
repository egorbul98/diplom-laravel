import $ from "jquery"
import {
    notificationMessage,
    TotalMsgError,
    MsgSuccess,
    MsgErrorInputFill
} from "./../fun"
(function () {

    let vis = require("vis-network/dist/vis-network");
    let $graph = $("#learning-path__graph-full");
    $(document).ready(function () {
        if ($("body").hasClass("learning-path")) {
            let courseId = $graph.attr("data-course-id");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "/training/ajax-get-learning-path",
                data: {
                    "course_id": courseId
                },
                success: function (response, status) {

                    let modules = response.modules;
                    // renderGraph(modules);
                    renderFullGraph(modules);
                },
                error: function (response, status) {
                    if (response.msg == undefined) {
                        notificationMessage(TotalMsgError, "error");
                    } else {
                        notificationMessage(response.msg, "error");
                    }

                },
            });


        }
    });

    function renderGraph(modules) {
        let dataEdgesModules = [];
        let dataNodesModules = [];

        for (let i = 0; i < modules.length - 1; i++) {
            const module = modules[i];
            const nextModule = modules[i + 1];

            let color = 'blue';

            let obj = dataNodesModules.find(node => node.id == module.id);
            if (obj == undefined) {
                dataNodesModules.push({
                    "id": module.id,
                    "label": module.title,
                });
            } else if ((i + 1) == (modules.length - 1)) {
                let obj = dataNodesModules.find(node => node.id == nextModule.id);
                if (obj == undefined) {
                    dataNodesModules.push({
                        "id": nextModule.id,
                        "label": nextModule.title,
                    });
                }
                color = 'red';
            } else {
                color = 'red';
            }

            let from = module.id,
                to = nextModule.id;
            dataEdgesModules.push({
                "from": from,
                "to": to,
                color: color
            });

        }
        console.log(dataEdgesModules, dataNodesModules);



        let container = document.getElementById('graph');
        let nodes = new vis.DataSet(dataNodesModules);
        let edges = new vis.DataSet(dataEdgesModules);

        let data = {
            nodes: nodes,
            edges: edges
        };

        let options = {
            edges: {
                arrows: "to",
                length: 600,
                physics: false,
                font: {
                    size: 12
                }
            },
            layout: {
                hierarchical: true,
                improvedLayout: true,
                hierarchical: {
                    enabled: false,
                    direction: "LR"
                }
            },
            physics: {
                stabilization: false
            }
        };
        let network = new vis.Network(container, data, options);
    }

    function renderFullGraph(modules) {
        let dataEdgesModules = [];
        let dataNodesModules = [];

        for (let i = 0; i < modules.length - 1; i++) {
            const module = modules[i];
            const nextModule = modules[i + 1];

            let color = 'blue';
            let obj = dataNodesModules.find(node => node.moduleId == nextModule.id);
            if (obj != undefined) {
                color = "red";
            }
            if (i + 1 == modules.length - 1) {
                dataNodesModules.push({
                    "id": i+1,
                    "label": nextModule.title,
                    "moduleId": nextModule.id,
                });
            }
            dataNodesModules.push({
                "id": i,
                "label": module.title,
                "moduleId": module.id,
                
            });

            let from = i,
                to = i + 1;

            dataEdgesModules.push({
                "from": from,
                "to": to,
                color: color
            });

        }

        let container = document.getElementById('learning-path__graph-full');
        let nodes = new vis.DataSet(dataNodesModules);
        let edges = new vis.DataSet(dataEdgesModules);

        let data = {
            nodes: nodes,
            edges: edges
        };

        let options = {
            edges: {
                arrows: "to",
                length: 600,
                physics: false,
                font: {
                    size: 12
                }
            },
            layout: {
                hierarchical: true,
                improvedLayout: true,
                hierarchical: {
                    enabled: false,
                    direction: "LR"
                }
            },
            physics: {
                stabilization: false
            }
        };
        let network = new vis.Network(container, data, options);
    }


})();
