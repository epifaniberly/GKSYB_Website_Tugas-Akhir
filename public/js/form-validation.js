

class FormValidator {
    constructor(formId) {
        this.form = document.getElementById(formId);
        if (!this.form) return;
        
        this.rules = {
            email: {
                pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                message: 'Format email tidak valid (contoh: nama@domain.com)'
            },
            phone: {
                pattern: /^[0-9]{9,15}$/,
                message: 'Nomor telepon tidak valid'
            },
            url: {
                pattern: /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,10})(\/[^\s]*)?$/,
                message: 'URL tidak valid (contoh: https://example.com)'
            },
            minLength: (length) => ({
                validate: (value) => value.length >= length,
                message: `Minimal ${length} karakter`
            }),
            maxLength: (length) => ({
                validate: (value) => value.length <= length,
                message: `Maksimal ${length} karakter`
            }),
            required: {
                validate: (value) => value.trim() !== '',
                message: 'Kolom ini wajib diisi'
            },
            matches: (otherId, message) => ({
                validate: (value) => value === document.getElementById(otherId).value,
                message: message || 'Data tidak cocok'
            })
        };
        this.fieldRules = new Map();
    }

    showError(input, message) {
        this.clearError(input);
        
        input.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500', 'bg-red-50', 'text-red-900');
        input.classList.remove('border-gray-300', 'focus:ring-[#8C1007]', 'focus:border-[#8C1007]');
        
        input.style.borderColor = '#ef4444';
        input.style.borderWidth = '2px';
        input.style.backgroundColor = '#fef2f2';
        input.style.color = '#7f1d1d';
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-600 text-[11px] mt-4 flex items-center gap-2 animate-in fade-in slide-in-from-top-1 duration-200 font-medium';
        errorDiv.innerHTML = `
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span>${message}</span>
        `;
        
        const parent = input.parentElement;
        if (parent.classList.contains('relative') || parent.classList.contains('flex')) {
            parent.after(errorDiv);
        } else {
            parent.appendChild(errorDiv);
        }
        
        input.dataset.errorElement = 'true';
    }

    clearError(input) {
        input.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500', 'bg-red-50', 'text-red-900');
        input.classList.add('border-gray-300', 'focus:ring-[#8C1007]', 'focus:border-[#8C1007]');
        
        input.style.borderColor = '';
        input.style.borderWidth = '';
        input.style.backgroundColor = '';
        input.style.color = '';
        
        
        const parent = input.parentElement;
        
        const errorSelectors = ['.text-red-600', '.text-red-500'];
        
        if (parent.classList.contains('relative') || parent.classList.contains('flex')) {
            let nextEl = parent.nextElementSibling;
            if (nextEl) {
                const isError = errorSelectors.some(sel => nextEl.matches(sel) || nextEl.querySelector(sel));
                if (isError) nextEl.remove();
            }
        }
        
        errorSelectors.forEach(selector => {
            const errorEl = parent.querySelector(selector);
            if (errorEl) errorEl.remove();
        });

        delete input.dataset.errorElement;
    }

    showFieldError(containerId, message) {
        const container = document.getElementById(containerId);
        if (!container) return;

        this.clearFieldError(containerId);

        container.classList.add('border-2', 'border-red-500', 'rounded-xl', 'p-3', 'bg-red-50/30');

        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-red-600 text-[11px] mt-2 flex items-center gap-2 animate-in fade-in slide-in-from-top-1 duration-200 font-medium field-error-message';
        errorDiv.innerHTML = `
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span>${message}</span>
        `;

        container.appendChild(errorDiv);
        container.dataset.hasError = 'true';
    }

    clearFieldError(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;

        container.classList.remove('border-2', 'border-red-500', 'rounded-xl', 'p-3', 'bg-red-50/30');

        const errorMsg = container.querySelector('.field-error-message');
        if (errorMsg) {
            errorMsg.remove();
        }

        delete container.dataset.hasError;
    }

    validateField(input, rules) {
        if (input.disabled) {
            this.clearError(input);
            return true;
        }
        const value = input.value;
        
        if (input.hasAttribute('required') || rules.includes('required')) {
            if (!this.rules.required.validate(value)) {
                this.showError(input, this.rules.required.message);
                return false;
            }
        }
        
        if (value.trim() === '') {
            this.clearError(input);
            return true;
        }
        
        for (const rule of rules) {
            if (typeof rule === 'string' && this.rules[rule]) {
                const ruleObj = this.rules[rule];
                if (ruleObj.pattern && !ruleObj.pattern.test(value)) {
                    this.showError(input, ruleObj.message);
                    return false;
                }
            } else if (typeof rule === 'object') {
                if (rule.validate && !rule.validate(value)) {
                    this.showError(input, rule.message);
                    return false;
                }
            }
        }
        
        this.clearError(input);
        return true;
    }

    addValidation(inputId, rules = []) {
        const input = document.getElementById(inputId);
        if (!input) return;

        this.fieldRules.set(input, rules);
        
        input.addEventListener('blur', () => {
            this.validateField(input, rules);
        });

        input.addEventListener('change', () => {
            this.validateField(input, rules);
        });
        
        input.addEventListener('input', () => {
             this.validateField(input, rules);
        });
    }

    validateForm() {
        let isValid = true;
        
        const validatedInputs = new Set();

        if (this.fieldRules) {
            for (const [input, rules] of this.fieldRules) {
                if (input.form === this.form) {
                    if (!this.validateField(input, rules)) {
                        isValid = false;
                    }
                    validatedInputs.add(input);
                }
            }
        }

        const inputs = this.form.querySelectorAll('input[required]:not(:disabled), textarea[required]:not(:disabled), select[required]:not(:disabled)');
        
        inputs.forEach(input => {
            if (validatedInputs.has(input)) return;

            const rules = ['required'];
            
            if (input.type === 'email') rules.push('email');
            if (input.type === 'tel') rules.push('phone');
            if (input.type === 'url') rules.push('url');
            
            if (input.dataset.minLength) {
                rules.push(this.rules.minLength(parseInt(input.dataset.minLength)));
            }
            if (input.dataset.maxLength) {
                rules.push(this.rules.maxLength(parseInt(input.dataset.maxLength)));
            }
            
            if (!this.validateField(input, rules)) {
                isValid = false;
            }
        });
        
        if (!isValid) {
            const firstError = this.form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
        
        return isValid;
    }

    clearErrors() {
        if (!this.form) return;
        const inputs = this.form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => this.clearError(input));
    }

    init() {
        if (!this.form) return;
        
        this.form.addEventListener('submit', (e) => {
            if (!this.validateForm()) {
                e.preventDefault();
                return false;
            }
        });
        
        const inputs = this.form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            const rules = [];
            
            if (input.hasAttribute('required')) rules.push('required');
            if (input.type === 'email') rules.push('email');
            if (input.type === 'tel') rules.push('phone');
            if (input.type === 'url') rules.push('url');
            if (input.dataset.minLength) rules.push(this.rules.minLength(parseInt(input.dataset.minLength)));
            if (input.dataset.maxLength) rules.push(this.rules.maxLength(parseInt(input.dataset.maxLength)));
            
            if (rules.length > 0) {
                this.addValidation(input.id, rules);
            }
        });
    }
}

function initFormValidation(formId) {
    const validator = new FormValidator(formId);
    validator.init();
    return validator;
}

if (typeof module !== 'undefined' && module.exports) {
    module.exports = { FormValidator, initFormValidation };
}
