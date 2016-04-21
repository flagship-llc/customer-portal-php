<?php
include("header.php");
$address = $servicePortal->getSubscription()->shippingAddress;
?>

<div class="container" style=>
    <div id="cb-wrapper-ssp">
		<?php include("processing.php") ?>
        <div id="cb-user-content">
            <form id="portal_shipping_address_update" action="update_shipping_address_info.php" method="POST">
            <div class="attention_text">
                Use the form below to update your shipping address for future renewals only. If you make a mistake or would like to edit the shipping address for remaining boxes per your most recent renewal, please contact support at <a href="mailTo:weloveyou@tokyotreat.com">weloveyou@tokyotreat.com</a>.
            </div>
                <div class="cb-well">
                    <h3 class="text-center">Shipping Information</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[first_name]">First Name <span>*</span>
                                </label>
                                <input id="shipping_address[first_name]" name="shipping_address[first_name]" type="text" 								class="form-control" value="<?php echo (isset($address->firstName) ? esc($address->firstName) : "" ) ?>" 
								required data-msg-required="cannot be blank" >
                                <span class="text-danger" id="shipping_address[first_name]"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[last_name]]">Last Name <span>*</span>
                                </label>
                                <input id="shipping_address[lastName]" name="shipping_address[last_name]" type="text" 								class="form-control" value="<?php echo (isset($address->lastName) ? esc($address->lastName) : "" ) ?>"
								required data-msg-required="cannot be blank" >
                                <span id="shipping_address[last_name]" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- <?php var_dump($address);?> -->
                                <label for="shipping_address[line1]">Address Line 1<span>*</span>
                                </label>
                                <input id="shipping_address[line1]" name="shipping_address[line1]" type="text" class="form-control"
                                    value="<?php echo (isset($address->line1) ? esc($address->line1) : "" ) ?>" 
                                    required data-msg-required="cannot be blank" >
                                <span id="shipping_address[line1]" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer[address2]">Address Line 2
                                </label>
                                <input id="shipping_address[line2]" name="shipping_address[line2]" type="text" class="form-control"   value="<?php echo (isset($address->line2) ? esc($address->line2) : "" ) ?>" validate="true">
                                <span id="shipping_address[line2]" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[city]">City <span>*</span>
                                </label>
                                <input id="shipping_address[city]" name="shipping_address[city]" type="text" class="form-control"
                                    value="<?php echo (isset($address->city) ? esc($address->city) : "" ) ?>" 
                                    required data-msg-required="cannot be blank" >
                                <span id="shipping_address[city]" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[zip]">Zip
                                </label>
                                <input id="shipping_address[zip]" name="shipping_address[zip]" type="text" class="form-control" value="<?php echo (isset($address->zip) ? esc($address->zip) : "" ) ?>" validate="true">
                                <span id="shipping_address[zip]" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[country]">Country <span>*</span>
                                </label>
                                <select name="shipping_address[country]" class="form-control" id="shipping_address[country]" name="shipping_address[country]" required data-msg-required="cannot be blank">
                                    <?php
                                    $countryCodes = $servicePortal->getCountryCodes($configData);
                                    $shippingCountry = null;
                                    if (isset($address->country) && isset($address->country)) {
                                        $shippingCountry = $address->country;
                                    }
                                    ?>
                                    <option value="" <?php echo ($shippingCountry == null ) ? "selected" : "" ?> >
                                        Select your country
                                    </option>
                                    <?php foreach ($countryCodes as $code => $country) { ?>
                                        <option value="<?php echo $code ?>" <?php echo ($code == $shippingCountry) ? "selected" : "" ?> >
                                            <?php echo $country ?>
                                        </option>
                                    <?php } ?>    
                                </select>
                                <span id="shipping_address[country]" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[state]">State 
                                </label>
                                <input id="shipping_address[state]" name="shipping_address[state]" type="text" class="form-control"  value="<?php echo (isset($address->state) ? esc($address->state) : "" ) ?>" >
                                <span id="shipping_address[state]" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[email]">Email <span>*</span>
                                </label>
                                <input id="shipping_address[email]" name="shipping_address[email]" type="text"                                class="form-control" value="<?php echo (isset($address->email) ? esc($address->email) : "" ) ?>" 
                                required data-msg-required="cannot be blank" >
                                <span class="text-danger" id="shipping_address[email]"></span>
                            </div>                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[phone]">Phone <span>*</span>
                                </label>
                                <input id="shipping_address[phone]" name="shipping_address[phone]" type="text"                                class="form-control" value="<?php echo (isset($address->phone) ? esc($address->phone) : "" ) ?>" 
                                required data-msg-required="cannot be blank" >
                                <span class="text-danger" id="shipping_address[phone]"></span>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="shipping_address[company]">Company
                                </label>
                                <input id="shipping_address[company]" name="shipping_address[company]" type="text"                              class="form-control"  value="<?php echo (isset($address->company) ? esc($address->company) : "" ) ?>" >
                                <span id="shipping_address[company]" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <hr class="clearfix">
                    <div class="form-inline">
                        <div class="form-group">
							<input name="action" value="updateShippingAddress" type="hidden">
                            <input name="update_shipping_true" value="true" type="hidden">
                            <input type="submit" id="updateShippingAddress" value="Update shipping address" class="btn
                                   btn-primary">
                        </div>
                        <div class="form-group">
                            <a href=<?php echo getCancelURL($configData) ?> id="back" class="btn btn-link">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
<script>
    $('#updateShippingAddress').click(function () {
		if(!$('#updateAddressForm').valid()){
			return false;
		}
		var params = $('#updateAddressForm').serialize();
        AjaxCallMessage('api.php', 'POST', 'json', params, 'editshipping');
		return false;
    });
</script>
