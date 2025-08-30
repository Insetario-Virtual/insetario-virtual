// Helper: create input element
function createInput(type, name, classes = '') {
    const input = document.createElement('input');
    input.type = type;
    input.name = name;
    input.className = classes;
    return input;
}

// Add new common name input
function addCommonName() {
    const wrapper = document.getElementById('commonNamesWrapper');
    if (wrapper) {
        const input = createInput('text', 'common_names[]', 'w-full border rounded p-2 mb-2');
        wrapper.appendChild(input);
    }
}

// Add new image input
function addImageInput() {
    const wrapper = document.getElementById('imagesWrapper');
    if (wrapper) {
        const input = createInput('file', 'images[]', 'w-full border rounded p-2 mb-2');
        wrapper.appendChild(input);
    }
}

// Handle dynamic family options based on selected order
function handleOrderChange(orders) {
    const orderSelect = document.getElementById('orderSelect');
    const familySelect = document.getElementById('familySelect');

    if (!orderSelect || !familySelect) return;

    orderSelect.addEventListener('change', function () {
        const orderId = this.value;
        familySelect.innerHTML = '<option value="">Select a family</option>';

        if (orderId) {
            const order = orders.find(o => o.id == orderId);
            if (order && order.families) {
                order.families.forEach(f => {
                    const option = document.createElement('option');
                    option.value = f.id;
                    option.textContent = f.name;
                    familySelect.appendChild(option);
                });
            }
        }
    });
}

// Initialize form interactions
export function initInsectForm(orders) {
    const addCommonBtn = document.getElementById('addCommonName');
    const addImageBtn = document.getElementById('addImage');

    if (addCommonBtn) {
        addCommonBtn.addEventListener('click', addCommonName);
    }

    if (addImageBtn) {
        addImageBtn.addEventListener('click', addImageInput);
    }

    handleOrderChange(orders);
}