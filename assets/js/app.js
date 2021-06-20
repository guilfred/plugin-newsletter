(function ($) {
    const $form = $('.form-nwslt-rap');

    $form.on('submit', (e) => {
        e.preventDefault();
        const $email = $('#email-nwsl');
        const $buttonSubmit = $('#submit-nwsl');
        const $path = `${$('#path-nwslt').val()}validate.php`;
        const $message = $('#message-newslt');
        if ($email === '') {
            return false;
        }
        $.ajax({
            url: $path,
            method: 'POST',
            data: { email: $email.val().trim() },
            beforeSend: () => $buttonSubmit.attr('disabled', 'disabled')
        })
            .done((data) => {
                const $data = JSON.parse(data);
                switch ($data.message) {
                    case 'success':
                        $email.val('');
                        $message.text($data.info);
                        break;
                    case 'error':
                        $message.text($data.info);
                        break;
                    default:
                        $email.val('');
                        $message.text($data.info);
                }
            })
            .always(() => {
                $buttonSubmit.removeAttr('disabled');
                setTimeout(() => {
                    $message.text('');
                }, 2000);
            })
    });
})(jQuery);
