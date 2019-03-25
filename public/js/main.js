/**
 * Created by hades on 09/05/2018.
 */
$(document).ready(function () {
    $("#content").markdown({
        autofocus: false,
        iconlibrary: 'fa'
    });//提供Markdown编辑器
    hljs.initHighlightingOnLoad();
});

function reply() {
    $('#content').val($('#content').val() + '@' + $('#reply-user').val() + '\n');
}