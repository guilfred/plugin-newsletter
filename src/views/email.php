<form class="form-nwslt-rap" action="">
    <input type="email" name="email-nwsl" id="email-nwsl" placeholder="Saisir votre adresse mail" required="required"/>
    <input type="hidden" id="path-nwslt" value="<?php echo plugin_dir_url(__FILE__);?>">
    <button id="submit-nwsl" class="submit-nwsl" type="submit">
        <img src="<?php echo \App\App::submitEmailButton(); ?>" alt="enveloppe" title="Envoyer">
    </button>
    <div id="message-newslt"></div>
</form>
