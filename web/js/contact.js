const cleave = new Cleave('#ContactForm-phone', {
    phone: true,
    phoneRegionCode: 'UZ',
    delimiter: '-',
    prefix: '+998',
    noImmediatePrefix: true,
    numericOnly: true
});