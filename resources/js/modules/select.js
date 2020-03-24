import $ from "jquery"

let competences = [];
$('.checkboxes ').on('click', "input", function () {
  // let $parent = $('.module-header-item__in-competence .select-competences__left');
  let $parent = $(this).closest(".select-competences__right")
    .siblings(".select-competences__left");
  // let text = $(this).parent("label").text().replace(/\s+/g, " ");
  let text = $(this).siblings(".text").text().replace(/\s+/g, " ");

  if ($(this).prop('checked')) {
    competences[text] = text;
  } else {
    delete competences[text];
  }
  renderCompetences($parent, competences);
  console.log(competences);
});
$(".select-competences__right .btn-add").on('click', function () {
  let val = $(this).siblings("input").val();
  if (val != '') {
    let str = `
      <p>
        <label>
          <input type="checkbox" name="complex" value="2"><span class="check"></span><span class="text">${val}</span></label>
      </p>
  `;
    $(this).parent().siblings(".checkboxes").append(str);
  }

});
$(".module-header-item .form-field input").on('click', function () {
  if ($(this).prop("checked")) {
    $(this).parent().siblings(".select-wrap").slideDown();
  } else {
    $(this).parent().siblings(".select-wrap").slideUp();
  }
  
});

function renderCompetences($parent, arr) {
  let str = '';
  console.log("sadasd");
  console.log(arr);
  for (const key in arr) {
    console.log("внутри");
    str += `
    <div class="select-competences-item">
      <p class="text"><input type="text" name="competencestitles[]" value="${arr[key]}" class="input-bg" readonly></p>
     
    </div>
    `;
  }
  $($parent).addClass("asdasd").html(str);
}