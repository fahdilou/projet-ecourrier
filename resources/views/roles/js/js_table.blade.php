<script>

    //Define variables for input elements
var fieldEl = document.getElementById("filter-field");
var typeEl = document.getElementById("filter-type");
var valueEl = document.getElementById("filter-value");

//Custom filter example
function customFilter(data){
    return data.car && data.rating < 3;
}

//Trigger setFilter function with correct parameters
function updateFilter(){
  var filterVal = fieldEl.options[fieldEl.selectedIndex].value;
  var typeVal = typeEl.options[typeEl.selectedIndex].value;

  var filter = filterVal == "function" ? customFilter : filterVal;

  if(filterVal == "function" ){
    typeEl.disabled = true;
    valueEl.disabled = true;
  }else{
    typeEl.disabled = false;
    valueEl.disabled = false;
  }

  if(filterVal){
    table.setFilter(filter,typeVal, valueEl.value);
  }
}

//Update filters on value change
document.getElementById("filter-field").addEventListener("change", updateFilter);
document.getElementById("filter-type").addEventListener("change", updateFilter);
document.getElementById("filter-value").addEventListener("keyup", updateFilter);

//Clear filters on "Clear Filters" button click
document.getElementById("filter-clear").addEventListener("click", function(){
  fieldEl.value = "";
  valueEl.value = "";

  table.clearFilter();
});



const table = new Tabulator("#mydatatable", {
    // height:"311px",
    responsiveLayout:"hide",
    layout:"fitColumns",
    responsiveLayout:"collapse",
    pagination:"local",
    paginationSize:10,
    langs:{
        "fr-fr":{ //French language definition
            "pagination":{
                "first":"Premier",
                "first_title":"Première Page",
                "last":"Dernier",
                "last_title":"Dernière Page",
                "prev":"Précédent",
                "prev_title":"Page Précédente",
                "next":"Suivant",
                "next_title":"Page Suivante",
                "all":"Toute",
            },
        }
    },
   
});


table.on("tableBuilt", () => {
    table.setLocale("fr-fr");
});

document.getElementById("download-xlsx").addEventListener("click", function(){
    table.download("xlsx", "data.xlsx", {sheetName:"My Data"});
});



</script>