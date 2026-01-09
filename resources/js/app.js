import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

import 'preline';

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("form").forEach(form => {
        if (form.dataset.loadingBound) return;
        form.dataset.loadingBound = "true";

        form.addEventListener("submit", () => {
            const btn = form.querySelector("[data-loading-button]");
            if (!btn) return;

            const text = btn.querySelector("[data-loading-text]");
            const loader = btn.querySelector("[data-loading-spinner]");

            btn.disabled = true;
            btn.classList.add("opacity-75", "cursor-not-allowed");

            if (text) text.classList.add("hidden");
            if (loader) loader.classList.remove("hidden");
        });
    });
});
