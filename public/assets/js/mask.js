function mask(input, type) {
    let value = input.value.toUpperCase();

    switch (type) {
        case 'CPF':
            value = value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            break;
        case 'RG':
            value = value.replace(/[^0-9X]/g, '');
            value = value.replace(/^(\d{2})(\d)/, '$1.$2');
            value = value.replace(/^(\d{2}\.\d{3})(\d)/, '$1.$2');
            value = value.replace(/^(\d{2}\.\d{3}\.\d{3})([Xx\d])$/, '$1-$2');
            break;
        case 'CEP':
            value = value.replace(/\D/g, '');
            value = value.replace(/(\d{5})(\d{1,3})$/, '$1-$2');
            break;
        case 'TEL':
            value = value.replace(/^(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
            value = value.substring(0, 14);
            break;
        case 'CEL':
            value = value.replace(/^(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            value = value.substring(0, 15);
            break;
        default:
            break;
    }

    input.value = value;
}