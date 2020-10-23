import PlacesField from "./components/places-field";
import PlacesFieldIndex from "./components/places-field-index";

Statamic.booting(() => {
    Statamic.$components.register("places-fieldtype", PlacesField);
    Statamic.$components.register("places-fieldtype-index", PlacesFieldIndex);
});
