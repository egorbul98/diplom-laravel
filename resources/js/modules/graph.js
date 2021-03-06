import $ from "jquery"
import {
    notificationMessage,
    TotalMsgError,
    MsgSuccess,
    MsgErrorInputFill
} from "./../fun"
(function () {

    let vis = require("vis-network/dist/vis-network");

    $(document).ready(function () {
        if ($("body").hasClass("graph-modules")) {
            let courseId = $(".course-header").attr("data-course-id");
            let sections = [];
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "/profile/ajax-get-course-sections",
                data: {
                    "course_id": courseId
                },
                success: function (response, status) {
                    sections = response.sections;

                    renderGraph(sections);
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



    //содержит ли массив массив
    function isInArray(arr, mainArr) {
        let count = 0; //Количество выходных компетенций, которые являются входными для другого модуля
        for (let i = 0; i < arr.length; i++) {
            if (mainArr.indexOf(arr[i]) !== -1) {
                count++;
            }
        }
        // if (count == mainArr.length && count!=0) {
        if (count != 0) {
            return true;
        } else {
            return false;
        }

    }

    function getEdges(modules) {
        let from, to;
        let edges = [];
        //MainModule - модуль от которого будет идти связь
        modules.forEach(mainModule => {
            for (let i = 0; i < modules.length; i++) {
                from = mainModule.id;
                const module = modules[i];
                if (mainModule.id == module.id) {
                    continue;
                }

                if (isInArray(mainModule.competencesOutIds, module.competencesInIds) && mainModule.competencesOutIds.length >= module.competencesInIds.length) {

                    let outCompetemsecString = '';
                    to = module.id;
                    mainModule.competencesOut.forEach(competence => {
                        outCompetemsecString += competence.title + "\n";
                    });

                    edges.push({
                        "from": from,
                        "to": to,
                        label: outCompetemsecString,
                        font: {
                            size: 12
                        }
                    });
                }
            }

        });
        return edges;
    }

    function renderGraph(sections) {
        sections.forEach(section => {
            let dataEdgesModules = [];
            let dataNodesModules = [];
            let color = '';
            dataEdgesModules = getEdges(section.modules);
            section.modules.forEach(module => {
                color = '';
                if (module.competencesInIds.length == 0) {
                    color = 'red';
                }
                dataNodesModules.push({
                    "id": module.id,
                    "label": module.title,
                    color: {
                        border: color
                    }
                })
            });

            let nodes = new vis.DataSet(dataNodesModules);
            let edges = new vis.DataSet(dataEdgesModules);


            let container = document.getElementById('graph' + section.id);
            let data = {
                nodes: nodes,
                edges: edges
            };

            let options = {
                edges: {
                    arrows: "to",
                    length: 600,
                    physics: false
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

        });



    }


})();
