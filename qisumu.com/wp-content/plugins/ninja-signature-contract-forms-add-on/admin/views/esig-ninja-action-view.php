<tr>
    <th scope="row">
        <label for="settings[signer_name]"><?php _e('Signer Name', 'esig-nfds'); ?><font color="red">*</font></label>
    </th>
    <td>
        <input name="settings[signer_name]" type="text" id="settings-signer_name" value="<?php echo $signer_name; ?>" class="nf-tokenize " placeholder="<?php _e('Name or fields', 'ninja-forms'); ?>" data-token-limit="0" data-key="signer_name" data-type="all">
        <span class="howto">Email will appear to be from this name.</span>
        <span id="signer-name-validation-msg" class="querystring-error"> </span>
    </td>

</tr>

<!-- Signer Email Address -->
<tr>
    <th scope="row">
        <label for="settings[signer_email_address]"><?php _e('Signer Email Address', 'esig-nfds'); ?><font color="red">*</font></label>
    </th>
    <td>
        <input name="settings[signer_email_address]" type="text" id="settings-signer_email_address" value="<?php echo $signer_email_address; ?>" class="nf-tokenize" placeholder="<?php _e('Name or fields', 'ninja-forms'); ?>" data-token-limit="0" data-key="signer_email" data-type="all">
        <span class="howto">Email will appear to be from this name.</span>
        <span id="signer-email-validation-msg" class="querystring-error"> </span>
    </td>

</tr>

<!-- Signing Logic -->
<tr>
    <th scope="row">
        <label for="settings[signing_logic]"><?php _e('Signing Logic', 'esig-nfds'); ?></label>
    </th>
    <td>

        <select name="settings[signing_logic]" class="gaddon-setting gaddon-select" id="signing_logic">
            <option value="redirect" <?php if ($signing_logic == "redirect") {
    echo "selected";
} ?>><?php _e('Redirect user to Contract/Agreement after Submission', 'esig-nfds'); ?></option>
            <option value="email" <?php if ($signing_logic == "email") {
    echo "selected";
} ?>><?php _e('Send User an Email Requesting their Signature after Submission', 'esig-nfds'); ?></option></select>
        <span class="howto"><?php _e('Please select your desired signing logic once this form is submitted.', 'esig-nfds'); ?></span>
    </td>


</tr>


<!-- select sad document -->
<tr>
    <th scope="row">
        <label for="settings[select_sad]"><?php _e('Select stand alone document', 'esig-nfds'); ?><font color="red">*</font></label>
    </th>
    <td>
        <select name="settings[select_sad]" id="select_sad">
            <?php
            if (class_exists('esig_sad_document')) {

                $sad = new esig_sad_document();
                $sad_pages = $sad->esig_get_sad_pages();
                 echo'<option value=""> '. __('Select an agreement page','esig-nfds') .' </option>';
                foreach ($sad_pages as $page) {
                    $selected = ($page->page_id == $select_sad) ? "selected" : null;
                    if (get_the_title($page->page_id)) {
                        echo '<option value="' . $page->page_id . '" ' . $selected . '> ' . get_the_title($page->page_id) . ' </option>';
                    }
                }
            }
            ?></select><br><span id="signer-select-sad-validation-msg" class="querystring-error"> </span><br>
        <select name="settings[underline_data]" id="settings-underline_data">
            <option value="underline" <?php if ($underline_data == "underline") {
                echo "selected";
            } ?> ><?php _e('Underline the data That was submitted from this ninja form', 'esig-nfds'); ?></option>
            <option value="not_under" <?php if ($underline_data == "not_under") {
                echo "selected";
            } ?>><?php _e('Do not underline the data that was submitted from the Ninja Form', 'esig-nfds'); ?></option>
        </select>
        <span class="howto"><?php _e('If you would like to can <a href="edit.php?post_type=esign&amp;page=esign-add-document&amp;esig_type=sad">create new document', 'esig-nfds'); ?></a></span>
</td>
</tr>

<tr>
    <th scope="row">
        <label for="settings[signing_reminder_email]"><?php _e('Signing Reminder Email', 'esig-nfds'); ?></label>
    </th>
    <td>
        <input name="settings[signing_reminder_email]" type="hidden" value="0"/>
        <input type="checkbox" name="settings[signing_reminder_email]" id="settings-signing_reminder_email" value="1" <?php checked($signing_reminder_email, 1); ?> /><?php _e('Enabling signing reminder email.If/When user has not sign the document', 'esig-nfds'); ?><br><br>
<?php _e('Send the reminder email to the signer in ', 'esig-nfds'); ?><input type="textbox" name="settings[reminder_email]" value="<?php echo $reminder_email; ?>" style="width:40px;height:30px;"><br><br>
<?php _e('After the first Reminder send reminder every ', 'esig-nfds'); ?><input type="textbox" name="settings[first_reminder_send]" value="<?php echo $first_reminder_send; ?>" style="width:40px;height:30px;"> <?php _e('Days Days', 'esig-nfds'); ?><br><br>
<?php _e('Expire reminder in ', 'esig-nfds'); ?><input type="textbox" name="settings[expire_reminder]" value="<?php echo $expire_reminder; ?>" style="width:40px;height:30px;"> Days
    </td>


</tr>