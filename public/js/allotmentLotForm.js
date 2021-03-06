<!-- Ajoute le formulaire plot au formulaire lots-->
    jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    var $plotsCollectionHolder = $('ul');
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $plotsCollectionHolder.data('index', $plotsCollectionHolder.find('li.existPlot').length);

    let $exisitPlotsCollectionHolder = $('li.existPlot')
    // add a delete link to all of the existing tag form li elements
    $exisitPlotsCollectionHolder.each(function() {
    addPlotFormDeleteLink($(this));
});

    $('body').on('click', '.add_item_link', function(e) {
    var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
    // add a new tag form (see next code block)
    addFormToCollection($collectionHolderClass);
})
});



    function addFormToCollection($collectionHolderClass) {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $('.' + $collectionHolderClass);

    // add a delete link to all of the existing tag form li elements

    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);


    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi)
    addPlotFormDeleteLink($newFormLi);




}
    function addPlotFormDeleteLink($plotFormLi) {
    var $removeFormButton = $('<button type="button" class="btn btn-outline-danger">Supprimer le lot</button>');
    $plotFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
    // remove the li for the tag form
    $plotFormLi.remove();
});
}


