            
            <form method="POST" enctype='multipart/form-data' >

           

                <div class="action_div_single">
                    <label for="" class="label_form"> Name </label>
                    <input  type="text" value="<?= $profile['name'] ? $profile['name'] : '' ?>" name="name" placeholder="Name..."  class="input_form">
                </div>

                <div class="action_div_single">
                    <label for="" class="label_form"> Description </label>
                    <input  type="text" value="<?= $profile['description'] ? $profile['description'] : '' ?>" style="height: 8rem;" name="description" placeholder="Description..."  class="input_form">
                </div>

                <div class="action_div_single">
                    <label for="" class="label_form"> Price </label>
                    <input  type="text" value="<?= $profile['price'] ? $profile['price'] : '' ?>" name="price" placeholder="Price..."  class="input_form">
                </div>

                <div class="action_div_single">
                    <label for="" class="label_form"> Stars </label>
                    <input  type="text" value="<?= $profile['stars'] ? $profile['stars'] : '' ?>" name="stars" placeholder="Stars..."  class="input_form">
                </div>

                <div class="action_div_single">
                    <label for="" class="label_form"> Location </label>
                    <input  type="text" value="<?= $profile['location'] ? $profile['location'] : '' ?>" name="location" placeholder="Location..."  class="input_form">
                </div>

              
                <input type="hidden" name="stuff_id" value="<?= $profile['id'] ?>" >

              <input type="submit" name="edit_profile" style="width: 100%;" class="mt-2 p-1 btn btn_signup" value="Submit" >

                </form>