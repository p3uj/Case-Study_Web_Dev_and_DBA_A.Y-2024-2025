function updatePopoverDataId(button) {
    // Get the data-id from the button
    var dataId = button.getAttribute('data-id');
    console.log('button data id:', dataId);

    // Get the popover div and update its data-id attribute
    var popover = document.querySelector('[popover]');
    popover.setAttribute('data-id', dataId);
}
