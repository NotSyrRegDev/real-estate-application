            
            <form method="POST" enctype='multipart/form-data' >

           

                <div class="action_div_single">
                    <label for="" class="label_form"> Requester Name</label>
                    <input  type="text" value="<?= $profile['requester_name'] ? $profile['requester_name'] : '' ?>" name="requester_name" placeholder="Name..."  class="input_form">
                </div>

                <div class="action_div_single">
                    <label for="" class="label_form"> Requester Phone </label>
                    <input  type="number" value="<?= $profile['requester_phone'] ? $profile['requester_phone'] : '' ?>" name="requester_phone" placeholder="Phone..."  class="input_form">
                </div>

              
                <input type="hidden" name="stuff_id" value="<?= $profile['id'] ?>" >

              <input type="submit" name="edit_profile" style="width: 100%;" class="mt-2 p-1 btn btn_signup" value="Submit" >

                </form>