// admin/js/validation.js

document.addEventListener('DOMContentLoaded', function() {
    // Helper functions for showing/clearing errors
    function showError(element, message) {
        element.textContent = message;
        // Assuming the input is the previous sibling of the error span
        const inputElement = element.previousElementSibling;
        if (inputElement) {
            inputElement.classList.add('input-error');
        }
    }

    function clearError(element) {
        element.textContent = '';
        const inputElement = element.previousElementSibling;
        if (inputElement) {
            inputElement.classList.remove('input-error');
        }
    }

    // --- Login Form Validation ---
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');

        loginForm.addEventListener('submit', function(event) {
            let isValid = true;
            clearError(usernameError);
            clearError(passwordError);

            if (usernameInput.value.trim() === '') {
                showError(usernameError, 'El usuario no puede estar vacío.');
                isValid = false;
            }
            if (passwordInput.value.trim() === '') {
                showError(passwordError, 'La contraseña no puede estar vacía.');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        usernameInput.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                showError(usernameError, 'El usuario no puede estar vacío.');
            } else {
                clearError(usernameError);
            }
        });

        passwordInput.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                showError(passwordError, 'La contraseña no puede estar vacía.');
            } else {
                clearError(passwordError);
            }
        });
    }

    // --- Article Form Validation (for both New and Edit) ---
    const articleForms = document.querySelectorAll('#newArticleForm, #editArticleForm');
    articleForms.forEach(function(form) {
        if (form) {
            const titleInput = form.querySelector('#title');
            const slugInput = form.querySelector('#slug');
            const contentInput = form.querySelector('#content');
            const categorySelect = form.querySelector('#category');

            const titleError = form.querySelector('#titleError');
            const slugError = form.querySelector('#slugError');
            const contentError = form.querySelector('#contentError');
            const categoryError = form.querySelector('#categoryError');

            // Regex for slug validation (lowercase letters, numbers, hyphens only)
            const slugRegex = /^[a-z0-9-]+$/;

            form.addEventListener('submit', function(event) {
                let isValid = true;

                // Clear previous errors
                clearError(titleError);
                clearError(slugError);
                clearError(contentError);
                clearError(categoryError);

                // Validate Title
                if (titleInput.value.trim() === '') {
                    showError(titleError, 'El título no puede estar vacío.');
                    isValid = false;
                }

                // Validate Slug
                if (slugInput.value.trim() === '') {
                    showError(slugError, 'El slug no puede estar vacío.');
                    isValid = false;
                } else if (!slugRegex.test(slugInput.value.trim())) {
                    showError(slugError, 'El slug solo puede contener letras minúsculas, números y guiones.');
                    isValid = false;
                }

                // Validate Content
                if (contentInput.value.trim() === '') {
                    showError(contentError, 'El contenido no puede estar vacío.');
                    isValid = false;
                }

                // Validate Category
                if (categorySelect.value === '') {
                    showError(categoryError, 'Debes seleccionar una categoría.');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });

            // Real-time validation for article form fields
            titleInput.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    showError(titleError, 'El título no puede estar vacío.');
                }
            });

            slugInput.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    showError(slugError, 'El slug no puede estar vacío.');
                } else if (!slugRegex.test(this.value.trim())) {
                    showError(slugError, 'El slug solo puede contener letras minúsculas, números y guiones.');
                } else {
                    clearError(slugError);
                }
            });

            contentInput.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    showError(contentError, 'El contenido no puede estar vacío.');
                }
            });

            categorySelect.addEventListener('change', function() {
                if (this.value === '') {
                    showError(categoryError, 'Debes seleccionar una categoría.');
                } else {
                    clearError(categoryError);
                }
            });

            // Clear errors on input for title and content
            titleInput.addEventListener('input', function() {
                clearError(titleError);
            });
            contentInput.addEventListener('input', function() {
                clearError(contentError);
            });
        }
    });
});
