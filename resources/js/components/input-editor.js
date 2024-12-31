import Quill from "quill";
import { merge } from 'lodash';

import "quill/dist/quill.core.css";
import "quill/dist/quill.bubble.css";
import "quill/dist/quill.snow.css";

class Editores {
    static editores = {};

    static add(id, options) {

        options = merge({
            modules: {
                toolbar: true,
            },
            placeholder: 'Escreva...',
            theme: 'snow'
        }, options);

        this.editores[id] = new Quill(`#${id}`, options);
    }

    static get(id) {
        return this.editores[id];
    }
}

window.Editores = Editores;