function initMultiselect() {
    checkboxStatusChange();

    document.addEventListener("click", function(evt) {
      var flyoutElement = document.getElementById('myMultiselect'),
        targetElement = evt.target;

      do {
        if (targetElement == flyoutElement) {

          return;
        }

        targetElement = targetElement.parentNode;
      } while (targetElement);


      toggleCheckboxArea(true);

    });
  }

  function checkboxStatusChange() {
    var multiselect = document.getElementById("mySelectLabel");
    var multiselectOption = multiselect.getElementsByTagName('option')[0];

    var values = [];
    var checkboxes = document.getElementById("mySelectOptions");
    var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

    for (const item of checkedCheckboxes) {
      var checkboxValue = item.getAttribute('value');
      values.push(checkboxValue);
    }

    var dropdownValue = "Pilih Pihak Penyetuju";
    if (values.length > 0) {
      dropdownValue = values.join(', ');
    }

    multiselectOption.innerText = dropdownValue;
    multiselectOption.value = dropdownValue;
  }

  function toggleCheckboxArea(onlyHide = false) {
    console.log("OKKK")
    var checkboxes = document.getElementById("mySelectOptions");
    var displayValue = checkboxes.style.display;

    if (displayValue != "block") {
      if (onlyHide == false) {
        checkboxes.style.display = "block";
      }
    } else {
      checkboxes.style.display = "none";
    }
  }


function initDatePicker() {
    const dateTags = document.querySelectorAll("input[type='date']");

    dateTags.forEach(dateTag => {
        dateTag.addEventListener('focus', function() {
            dateTag.showPicker();
            console.log("OK")
        });
    });
}

window.onload = (event) => {
    initMultiselect();
    initDatePicker();
};
