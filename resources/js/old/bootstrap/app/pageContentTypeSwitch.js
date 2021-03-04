import $ from 'jquery'

const $pageTypeSelect = $('#pageType')
const $pageContentTypeEditor = $('#pageContentTypeEditor')
const $pageContentTypeLink = $('#pageContentTypeLink')

if ($pageTypeSelect[0]) {
    $pageTypeSelect.on('change', function () {
        if ($pageTypeSelect.val() == 'LINK') {
            if (!$pageContentTypeEditor.hasClass('d-none')) {
                $pageContentTypeEditor.addClass('d-none')
            }

            if ($pageContentTypeLink.hasClass('d-none')) {
                $pageContentTypeLink.removeClass('d-none')
            }
        }

        if ($pageTypeSelect.val() == 'PAGE') {
            if ($pageContentTypeEditor.hasClass('d-none')) {
                $pageContentTypeEditor.removeClass('d-none')
            }

            if (!$pageContentTypeLink.hasClass('d-none')) {
                $pageContentTypeLink.addClass('d-none')
            }
        }
    });
}
