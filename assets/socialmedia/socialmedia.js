//  _        _      _         _
// | |  _  _| |_  _| |__ _  _| |__ _  _
// | |_| || | | || | '_ \ || | '_ \ || |
// |____\_,_|_|\_,_|_.__/\_,_|_.__/\_,_|
//
// Copyright © Lulububu Software GmbH - All Rights Reserved
// https://lulububu.de
//
// Unauthorized copying of this file, via any medium is strictly prohibited!
// Proprietary and confidential.

const getCheckboxValue = (checkboxInput) => new Promise((resolve) => {
    setTimeout(() => resolve(checkboxInput.getAttribute('value') === 'true'), 1);
});

const onInputChange = (saveInput, valueInputs, selectInputs, checkboxInputs) => async () => {
    const values = {};

    valueInputs.forEach((input) => {
        if (input.value) {
            values[input.name] = input.value;
        } else {
            delete values[input.name];
        }
    });

    selectInputs.forEach((input) => {
        const parent      = input.closest('.lulububu-field');
        const selectInput = parent.querySelector('input[type="hidden"]');
        const [value]     = JSON.parse(selectInput.value);

        if (value) {
            values[selectInput.name] = value;
        } else {
            delete values[selectInput.name];
        }
    });

    // eslint-disable-next-line no-restricted-syntax
    for (const input of checkboxInputs) {
        const parent        = input.closest('.lulububu-field');
        const checkboxInput = parent.querySelector('input[type="hidden"]');
        const name          = checkboxInput.name.split('-')[0];

        // eslint-disable-next-line no-await-in-loop
        const value = await getCheckboxValue(checkboxInput);

        if (value) {
            values[name] = value;
        } else {
            delete values[name];
        }
    }

    // eslint-disable-next-line no-param-reassign
    saveInput.value = JSON.stringify(values);
};

const initializeSocialMediaFieldGroup = (group) => {
    const saveInput      = group.querySelector('.lulububu-save-field[type="hidden"]');
    const valueInputs    = group.querySelectorAll('input.lulububu-field:not([type="hidden"])');
    const selectInputs   = group.querySelectorAll('.lulububu-select .lulububu-field .multiselect__element > span');
    const checkboxInputs = group.querySelectorAll('.lulububu-checkbox input[type="checkbox"]');
    const allInputs      = [...valueInputs, ...selectInputs, ...checkboxInputs];

    allInputs.forEach((input) => input.addEventListener('input', onInputChange(saveInput, valueInputs, selectInputs, checkboxInputs)));
    selectInputs.forEach((input) => input.addEventListener('click', onInputChange(saveInput, valueInputs, selectInputs, checkboxInputs)));
};

const initializeSocialMediaFieldGroups = () => {
    const fieldGroups             = document.querySelectorAll('.lulububu-input-group');
    const addBlockButtonContainer = document.querySelector('[aria-labelledby="content-dropdownMenuButton"]');

    fieldGroups.forEach(initializeSocialMediaFieldGroup);

    if (addBlockButtonContainer) {
        const addBlockButtons = addBlockButtonContainer.querySelectorAll('.dropdown-item');

        addBlockButtons.forEach((input) => input.addEventListener('click', initializeSocialMediaFieldGroups));
    }
};

const initializeSocialMedia = () => {
    initializeSocialMediaFieldGroups();
};

document.addEventListener('DOMContentLoaded', initializeSocialMedia, false);
