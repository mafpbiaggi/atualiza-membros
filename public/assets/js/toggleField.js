function toggleField(triggerSelector, valuesEnable, targetSelector) {
    const trigger = $(triggerSelector);
    const target = $(targetSelector);
    if (trigger.length == 0 || target.length == 0) return;

    const currentValue = trigger.val();
    const enable = Array.isArray(valuesEnable)
        ? valuesEnable.includes(currentValue)
        : currentValue == valuesEnable;

    if (enable) {
        target.prop('disabled', false);
    } else {
        target.val('');
        target.prop('disabled', true);
    }
}

$('#estadocivil').on('change', function() {
    toggleField('#estadocivil', ['2', '6'], '#datacasamento');
    toggleField('#estadocivil', ['2', '6'], '#nomeconjuge');
});

$('#batizado').on('change', function() {
    toggleField('#batizado', ['1'], '#databatismo');
    toggleField('#batizado', ['1'], '#pastorbatismo');
    toggleField('#batizado', ['1'], '#igrejabatismo');
});

$('#profissaofe').on('change', function() {
    toggleField('#profissaofe', ['1'], '#dataprofe');
    toggleField('#profissaofe', ['1'], '#pastorprofe');
    toggleField('#profissaofe', ['1'], '#igrejaprofe');
});
