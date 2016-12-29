<?php if (!isset($subscription->shippingAddress)) { ?>
   <div class="text-center">
            <div class="alert alert-info">
                <div class="media text-left">
                    <span class="glyphicon glyphicon-info-sign pull-left"></span>
                    <div class="media-body">
                        <?php echo $infoconfigData['Shipping_Information']['No_shipping_address_present']; ?>
                    </div>
                </div>
            </div>
	</div>
<?php } else { ?>               
    <address>

        <?php $shippingAddress = $subscription->shippingAddress ?>
            <b>
        	<?php echo (isset($shippingAddress->firstName) ? esc($shippingAddress->firstName) : "" ) ?>
			<?php echo (isset($shippingAddress->lastName) ? esc($shippingAddress->lastName) . "<br>" : "") ?>
            </b>
        	<?php echo (isset($shippingAddress->company) ? esc($shippingAddress->company) . "<br>" : "") ?>
        	<?php echo (isset($shippingAddress->line1) ? $shippingAddress->line1 . "," : "") ?>
        	<?php echo (isset($shippingAddress->line2) ? $shippingAddress->line2 . "," : "") ?>
        	<?php echo (isset($shippingAddress->city) ? $shippingAddress->city . "," : "") ?>
        	<?php echo (isset($shippingAddress->state) ? $shippingAddress->state . "," : "") ?>
        	<?php $countryCodes = $servicePortal->getCountryCodes($configData); ?>
        	<?php echo (isset($shippingAddress->country) ? $countryCodes[$shippingAddress->country] . "," : "" ) ?>
			<?php echo (isset($shippingAddress->zip) ? $shippingAddress->zip . "" : "") ?>
            <br>
            <br>
            <?php echo (isset($shippingAddress->phone) ? 'Phone: '.$shippingAddress->phone . "<br>" : "") ?>
            <?php echo (isset($shippingAddress->email) ? 'Email: '.$shippingAddress->email . "<br>" : "") ?>
    </address>
<?php } ?>