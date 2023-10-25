import {Form, Field, ErrorMessage, defineRule, configure} from "vee-validate";
import {required, max} from "@vee-validate/rules";
import {localize} from "@vee-validate/i18n";

configure({
    generateMessage: localize('en', {
        messages: {
            required: '{field} is required',
            max: '{field} can only have a maximum of 0:{max} characters'
        }
    })

})
export default (app) => {
    defineRule('required', required)
    defineRule('max', max)

    app.component('VeeForm', Form)
    app.component('VeeField', Field)
    app.component('VeeErrorMessage', ErrorMessage)
}