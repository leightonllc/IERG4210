var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    const popoverId = popoverTriggerEl.attributes['data-content-id'];
    if (popoverId) {
        const contentEl=$(`#${popoverId.value}`).html();
        return new bootstrap.Popover(popoverTriggerEl, {
            content: contentEl,
            html: true,
            sanitize: false,
            container: 'body',
        });
    }else{//do something else cause data-content-id isn't there.
    }
})