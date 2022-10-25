<?php
extract($_POST);
?>

<?php
if ($membership == 1) :
?>

	<?php
	// $penalty = $monthly * ($penalty/100);
	$interest = 0.01;
	$total_interest = ($amount * ($interest)) * $months;
	$monthly = ($amount + $total_interest) / $months;

	$share_capital = 0.01 * $amount; 	//for members only
	$service_charge = 0.01 * $amount; //fixed service charge
	$notarial_fee = 100; 	//fixed notarial fee

	$total_less = $share_capital + $service_charge + $notarial_fee;
	$net = $amount - ($share_capital + $service_charge + $notarial_fee);
	?>
	<hr>

	<table width="100%">
		<tr>
			<th class="text-center" width="33.33%">Monthly Payable</th>
			<th class="text-center" width="33.33%">Principal Amount + Interest</th>
		</tr>
		<tr>
			<td class="text-center" name="monthly_payment"><small><?php echo number_format($monthly, 2) ?></small></td>
			<td class="text-center" name="principal_amount"><small><?php echo number_format($months * $monthly, 2) ?></small></td>
		</tr>
	</table>
	<hr>
	<table width="100%">
		<tr class="pl-3">
			<th>Less:</th>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Share Capital </strong><i> (for members only)</i> 1% <strong>: </strong>
			</td>
			<td class="text-right">
				&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($share_capital, 2) ?>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Service Charge </strong>1%<strong>: </strong>
			</td>
			<td class="text-right">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($service_charge, 2) ?>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Notarial fee: </strong>
			</td>
			<td class="text-right">
				<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($notarial_fee, 2) ?></u>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td class="text-right">
				<strong> = </strong> <?php echo number_format($total_less, 2) ?>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Net Proceeds: </strong>
			</td>
			<td class="text-right">
				<u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($net, 2) ?></u>
			</td>
		</tr>
	</table>

<?php
elseif ($membership == 0) :
?>

	<?php
	// $penalty = $monthly * ($penalty/100);
	$interest = 0.01;
	$total_interest = ($amount * ($interest)) * $months;
	$monthly = ($amount + $total_interest) / $months;

	// $share_capital = 0.01 * $amount; 	//fixed capital for members only
	$service_charge = 0.01 * $amount; //fixed service charge
	$notarial_fee = 100; 	//fixed notarial fee

	$total_less = $service_charge + $notarial_fee;
	$net = $amount - ($service_charge + $notarial_fee);
	?>
	<hr>

	<table width="100%">
		<tr>
			<th class="text-center" width="33.33%">Monthly Payable</th>
			<th class="text-center" width="33.33%">Principal Amount + Interest</th>
		</tr>
		<tr>
			<td class="text-center" name="monthly_payment"><small><?php echo number_format($monthly, 2) ?></small></td>
			<td class="text-center" name="principal_amount"><small><?php echo number_format($months * $monthly, 2) ?></small></td>
		</tr>
	</table>
	<hr>
	<table width="100%">
		<tr class="pl-3">
			<th>Less:</th>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Service Charge </strong>1%<strong>: </strong>
			</td>
			<td class="text-right">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($service_charge, 2) ?>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Notarial fee: </strong>
			</td>
			<td class="text-right">
				<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($notarial_fee, 2) ?></u>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td class="text-right">
				<strong> = </strong> <?php echo number_format($total_less, 2) ?>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Net Proceeds: </strong>
			</td>
			<td class="text-right">
				<u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format($net, 2) ?></u>
			</td>
		</tr>
	</table>

<?php endif; ?>