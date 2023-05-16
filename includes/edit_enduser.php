            
            <form method="POST" enctype='multipart/form-data' >

           
            <div class="action_div_single">
                                <label for="" class="label_form">Image</label>
                                <img src="<?= $profile['image'] ? BASE_URL . "/assets/uploads/" . $profile['image'] :  "$imgAssets" . '/icons/user.png' ?>" class="avatar_icon" alt="">

                               <input type="file" name="image" id="" class="input_form">
                               
                            </div>
                            <div class="action_div_single">
                                <label for="" class="label_form">Name</label>
                                <input  type="text" value="<?= $profile['name'] ? $profile['name'] : '' ?>" name="name" placeholder="Name..."  class="input_form">
                            </div>
        
                            <div class="action_div_single">
                                <label for="" class="label_form">Email</label>
                                <input  type="email" value="<?= $profile['email'] ? $profile['email'] : '' ?>" name="email" placeholder="Email..."  class="input_form">
                            </div>
                            <div class="action_div_single">
                                <label for="" class="label_form">Password</label>
                                <input  type="passowrd" value="" name="password" placeholder="Password..."  class="input_form">
                            </div>

        
                            <div class="action_div_single">
                                <label for="" class="label_form"> Phone Number </label>
                                <input  type="number" value="<?= $profile['phone'] ? $profile['phone'] : '' ?>" name="phone" placeholder="Phone Number..."  class="input_form">
                            </div>

                            <div class="action_div_single">
                                <label for="" class="label_form"> Civil Registry </label>
                                <input  type="number" value="<?= $profile['civil_registry'] ? $profile['civil_registry'] : '' ?>" name="civil_registry" placeholder="Civil Registry..."  class="input_form">
                            </div>

                            <input type="hidden" name="stuff_id" value="<?= $profile['id'] ?>" >
        
                          <input type="submit" name="edit_profile" style="width: 100%;" class="mt-2 p-1 btn btn_signup" value="Submit" >
        
                            </form>