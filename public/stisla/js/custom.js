/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";


function actionDelete()
{
    $(document).on('click', '[data-delete]', function (e) {
        e.preventDefault();
    });
}

$(document).ready(function () {
    actionDelete();
});
