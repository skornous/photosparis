<nav class="blue" style="line-height: 64px;">
    <div class="nav-wrapper" style="line-height: 64px;">
        <div class="row">
            <div class="col s12">
<!--                <div id="link_menu">-->
<!--                    <a href="#" class="brand-logo">Photo Paris</a>-->
<!--                    <ul class="right hide-on-med-and-down">-->
<!--                        <li><a href="--><?php //echo fb_goto('vote');?><!--">Voter</a></li>-->
<!--                        <li><a href="--><?php //echo fb_goto('grid');?><!--">Toutes les photos</a></li>-->
<!--                        <li><a href=""><i class="material-icons">settings</i></a></li>-->
<!--                    </ul>-->
<!--                </div>-->
                <div id="icon_menu">
                    <a class="left modal-trigger" href="#modal_info"><i class="material-icons">info</i></a>
                    <ul class="right">
                        <li <?php if($page=="vote") echo "class=\"active\""; ?>><a href="<?php echo fb_goto('vote');?>" class="tooltipped" data-position="down" data-delay="50" data-tooltip="Voter"><i class="material-icons">view_carousel</i></a></li>
                        <li <?php if($page=="grid") echo "class=\"active\""; ?>><a href="<?php echo fb_goto('grid');?>" class="tooltipped" data-position="down" data-delay="50" data-tooltip="Voir toutes les photos"><i class="material-icons">view_module</i></a></li>
                        <li id="settings_button"><a><i class="material-icons pointer">mode_edit</i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<div id="settings_bar" class="z-depth-1 blue darken-4">
    <div class="row">
        <div class="s12">
            <ul class="tabs">
                <li class="tab col s6"><a href="#settings" class="blue-text">Paramètres</a></li>
                <li class="tab col s6"><a href="#user_photo" class="blue-text">Ma photo</a></li>
            </ul>
        </div>
    </div>
    <div id="settings" class="col s12">
        <div class="row">
            <form class="col s12" method="post" action="#">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="begin_date" type="text" class="datepicker">
                        <label for="begin_date">Date de début du concours</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="end_date" type="text" class="datepicker">
                        <label for="end_date">Date de <fin></fin> du concours</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="begin_submission" type="date" class="datepicker">
                        <label for="begin_submission">Date de début des submissions</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="end_submission" type="date" class="datepicker">
                        <label for="end_submission">Date de fin des submissions</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <input type="submit" class="right btn btn-large" value="Valider" />
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div id="user_photo" class="col s12">
        <form action="#" method="post">
            <div class="row" id="preview_photo">
                <div class="col s12 center">
                    <a href="#modal_upload" class="modal-trigger">
                        <img src="<?php echo fb_img('88070cbaa.jpg'); ?>" max-height="400" class="tooltipped hoverable" data-position="down" data-delay="50" data-tooltip="Cliquez pour modifier l'image"  />
                    </a>

                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <input type="submit" class="right btn btn-large" value="Valider" />
                </div>
            </div>
        </form>
    </div>

</div>

<!--<div class="fixed_param">-->
<!--    <a class="btn-floating btn-small blue">-->
<!--        <i class="material-icons">settings</i>-->
<!--    </a>-->
<!--    <ul>-->
<!--        <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>-->
<!--        <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>-->
<!--    </ul>-->
<!--</div>-->

<div id="modal_info" class="modal">
    <div class="modal-content center-align">
        <h4>À propos</h4>
        <p>Photos Paris est une application intégrée au réseau social Facebook permettant de réaliser un concours photos, ouvert à tous les utilisateurs de Facebook.
        <br>Il est réalisé dans le cadre d'un projet scolaire par un groupe d'étudiants en informatique, et hébergé sur le serveur d'applications Heroku.
        <br>Il est disponible sur la page fan de <a href="https://www.facebook.com/pages/Photo-Paris/803180603102053">Photos Paris</a>.</p>
    </div>
</div>

<div id="modal_upload" class="modal">
    <div class="center-align">
        <div class="row">
            <div class="s12">
                <ul class="tabs">
                    <li class="tab col s6"><a href="#photo_album" class="blue-text active">PHOTOS DE MON ALBUM</a></li>
                    <li class="tab col s6"><a href="#photo_upload" class="blue-text">UPLOADER UNE PHOTO</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal-content">
        <div id="photo_upload" class="col s12">
            <div class="row">
                <div class="col s12">
                    <form action="#">
                        <div class="file-field input-field">
                            <input class="file-path" type="text"/>
                            <div class="btn">
                                <span>PARCOURIR</span>
                                <input type="file" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="photo_album" class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <select>
                        <option value="" disabled selected>Photo Paris</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                    <label>Album</label>
                </div>
            </div>
            <div class="row">
                <ul class="col s12 photo_list">
                    <li class="col s2 valign-wrapper pointer center-align" style="padding:0 1px;"><img class="valign hoverable" src="<?php echo fb_img('523c8bbb45.jpg'); ?>" /></li>
                    <li class="col s2 valign-wrapper pointer center-align" style="padding:0 1px;"><img class="valign hoverable" src="<?php echo fb_img('2ca346a.jpg'); ?>" /></li>
                    <li class="col s2 valign-wrapper pointer center-align" style="padding:0 1px;"><img class="valign hoverable" src="<?php echo fb_img('74878982.jpg'); ?>" /></li>
                    <li class="col s2 valign-wrapper pointer center-align" style="padding:0 1px;"><img class="valign hoverable" src="<?php echo fb_img('c7ad74c.jpg'); ?>" /></li>
                    <li class="col s2 valign-wrapper pointer center-align" style="padding:0 1px;"><img class="valign hoverable" src="<?php echo fb_img('7574984.jpg'); ?>" /></li>
                    <li class="col s2 valign-wrapper pointer center-align" style="padding:0 1px;"><img class="valign hoverable" src="<?php echo fb_img('20619491.jpg'); ?>" /></li>

                </ul>
            </div>
            <div class="row">
                <div class="col s12 center-align">
                    <ul class="pagination">
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <a href="#" class="btn waves-effect waves-light modal-action modal-close" type="submit" name="action">Valider<i class="material-icons right">done</i></a>
        <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat ">Annuler</a>
    </div>
</div>