function handle(selectedCategory) {
    let xhttp = getSubcategories(selectedCategory.value);
    if (xhttp.status != 200) {
        return;
    }
    selectedCategory.setAttribute("disabled", "");
    let subcategories = JSON.parse(xhttp.responseText);
    appendNewSelectSubcategory(selectedCategory, subcategories);
}

function getSubcategories(id) {
    const csrf = document.querySelector('meta[name="csrf-token"]');
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://localhost:8080/subcategories/" + id, false);
    xhttp.setRequestHeader('X-CSRF-TOKEN', csrf.content)
    xhttp.send();
    return xhttp;
}

function appendNewSelectSubcategory(selectedCategory, subcategories) {
    let newSelect = prepareNewSelect(selectedCategory, subcategories);
    document.body.appendChild(newSelect);
}

function prepareNewSelect(selectedCategory, subcategories) {

    let selectElement = createSelectElement(selectedCategory);

    let disabledOption = createDisabledOption();
    let firstSubcategoryOption = createSelectSubcategoryOption(subcategories[0]);
    let secondSubcategoryOption = createSelectSubcategoryOption(subcategories[1]);

    selectElement.options.add(disabledOption);
    selectElement.options.add(firstSubcategoryOption);
    selectElement.options.add(secondSubcategoryOption);

    return  selectElement;
}

function createSelectElement(selectedCategory) {
    let select = document.createElement("select");
    select.setAttribute("name", selectedCategory.name);
    select.setAttribute("id", selectedCategory.name);
    select.setAttribute("onchange", 'handle(this)');

    return select;
}

function createDisabledOption() {
    let disabledOption = document.createElement("option");
    disabledOption.setAttribute("disabled", "");
    disabledOption.setAttribute("selected", "");
    disabledOption.setAttribute("value", "");
    disabledOption.innerHTML = "-- select a Category --";

    return disabledOption;
}

function createSelectSubcategoryOption(subcategory) {
    let subcategoryOption = document.createElement("option");
    subcategoryOption.setAttribute("value", subcategory["id"]);
    subcategoryOption.setAttribute("id", subcategory["id"]);
    subcategoryOption.innerHTML = subcategory["name"];

    return subcategoryOption;
}