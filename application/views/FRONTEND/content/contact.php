
    <div class="faq-page contact-page">
        <div class="container">
            <h1>CONTACT US</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.699168774956!2d106.68572014906997!3d10.757652192296616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1aa9aba7df%3A0x79e73ffafaf47f3c!2zNDU5LzE3QSBUcuG6p24gSMawbmcgxJDhuqFvLCBD4bqndSBLaG8sIFF14bqtbiAxLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1482911720391"  frameborder="0" style="border:0;width:100%;height:433px;" allowfullscreen></iframe>
            

            <h2 class="contact-text-getintouch">get in touch</h2>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="contact-info-block-left">
                        <div class="hr-line-right"></div>
                        <div class="contact-text-desc">For all contacts, please fill in your details into our form and we will reply via email within 4 hours. (If you don't hear from us, please you check your spam or junk mail folder or call – whatsapp us: <strong style="color:#61a78b;display:inline-block;"><?=$setting?stripslashes($setting->phone):""?> (Mr. Trung)</strong></div>
					    <?php 
                            //$aa = $this->session->userdata('ori_contact'); 
                            if($aa == 1){ ?>
                            <div style="padding:25px; font-size:25px; text-align:center;">
                                Send message success!.
                            </div>
                            <?php }else{ ?>
                            <?php if($aa == 2){ ?>
                            <div style="padding:25px; font-size:25px; text-align:center;">
                                Send message error!.
                            </div>
                            <?php } ?>
                            <form action="<?=PATH_URL?>contact/send" method="post" enctype="multipart/form-data"  class="contact-form">
                                <input type="text" name="txtName" class="txtinput" placeholder="FULL NAME" required>        
                                <input type="email" name="txtEmail" class="txtinput" placeholder="EMAIL ADDRESS" required>
                                <input type="text" name="txtAddress" class="txtinput" placeholder="NATIONAL" required>
                                <input type="text" name="txtPhone" class="txtinput" placeholder="SUBJECT" required>
                                <textarea name="txtMessage" id="" cols="30" rows="10" class="txtinput" placeholder="SAY HELLO TO SAIGON ADVENTURE!" required></textarea>
                                <div><button type="submit" name="sendContact" class="gold-btn">Send message</button></div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <div class="contact-info-block">
                        <h3><?=$setting?stripslashes($setting->owner_company):""?> <br>COMPANY LIMITED</h3>
                        <table cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td width="100" valign="top"><strong>Email:</strong></td>
                                <td valign="top"><?=$setting?stripslashes($setting->email):""?></td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Hotline:</strong></td>
                                <td valign="top"><?=$setting?stripslashes($setting->owner_address):""?></td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Phone:</strong></td>
                                <td valign="top"><?=$setting?stripslashes($setting->phone):""?></td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Address:</strong></td>
                                <td valign="top"><?=$setting?stripslashes($setting->address):""?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    