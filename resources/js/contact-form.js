/**
 * Contact form: checks the fields in the browser so an empty or wrong submit shows the
 * problems straight away instead of reloading the page. The server still validates
 * everything (and its messages arrive in `serverErrors` after a reload).
 *
 * Errors appear when the visitor leaves a field they have typed in, or when they press
 * Submit. A shown error clears as soon as the field is fixed.
 *
 * @param {{ messages: Record<string, Record<string, string>>, serverErrors: Record<string, string[]> }} config
 */
export default function contactForm({ messages, serverErrors }) {
    return {
        submitting: false,
        errors: {},
        touched: {},

        init() {
            for (const [name, list] of Object.entries(serverErrors || {})) {
                this.errors[name] = list[0];
            }

            const firstServerError = this.firstInvalidField();
            if (firstServerError) {
                this.$nextTick(() => firstServerError.focus());
            }
        },

        /** The message for a field's current problem, or '' when it is fine. */
        messageFor(field) {
            const text = messages[field.name] || {};
            const validity = field.validity;

            if (validity.valueMissing) {
                return text.required || '';
            }
            if (validity.typeMismatch || validity.patternMismatch) {
                return text.invalid || '';
            }

            return '';
        },

        check(field) {
            if (!field?.name || !field.willValidate) {
                return;
            }

            const message = this.messageFor(field);
            if (message) {
                this.errors[field.name] = message;
            } else {
                delete this.errors[field.name];
            }
        },

        /** Leaving a field shows its error, but only once the visitor has typed or picked something. */
        onBlur(event) {
            if (this.touched[event.target.name]) {
                this.check(event.target);
            }
        },

        onInput(event) {
            this.touched[event.target.name] = true;
            if (this.errors[event.target.name]) {
                this.check(event.target);
            }
        },

        /** Selects and the checkbox commit on change, so check them right away. */
        onChange(event) {
            this.touched[event.target.name] = true;
            if (event.target.matches('select, [type=checkbox]') || this.errors[event.target.name]) {
                this.check(event.target);
            }
        },

        hasError(name) {
            return Boolean(this.errors[name]);
        },

        firstInvalidField() {
            return [...this.$root.elements].find((field) => field.name && this.errors[field.name]);
        },

        submit(event) {
            for (const field of this.$root.elements) {
                this.check(field);
            }

            const firstInvalid = this.firstInvalidField();
            if (firstInvalid) {
                event.preventDefault();
                firstInvalid.focus();

                return;
            }

            this.submitting = true;
        },
    };
}
