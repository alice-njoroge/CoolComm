import {Form, Field, ErrorMessage, defineRule} from "vee-validate";
import {required, max} from "@vee-validate/rules";


export default (app) => {
    defineRule('required', required )
    defineRule('max', max)

    app.component('VeeForm', Form)
    app.component('VeeField', Field)
    app.component('VeeErrorMessage', ErrorMessage)
}