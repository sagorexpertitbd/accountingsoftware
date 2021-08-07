<div class="print_button">
  <button class="btn btn-info" onclick="printReport()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
</div>

<div id="tab1">

<h5 class="company_name"><?php echo e($company_name); ?></h4>
<div class="title">Income Statement</div>
<div class="title small"><?php echo e($title_date); ?></div>

<table class="responsive table table-bordered">
  <tbody>
<?php $surplusAmount = 0; ?>
<?php $__currentLoopData = $accTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td colspan="2" class="bg-light_1"><b><?php echo e($accType->type_name); ?></b></td>
    </tr>
    <tr>
      <td class="pl-4 bg-light_2"><b>Particulars</b></td>
      <td width="20%" class="text-right bg-light_2"><b>Amount</b></td>
    </tr>

    <?php $ttlAmount = 0; ?>
    <?php if(array_key_exists($accType->id, $glLedgers)): ?>
    <?php $__currentLoopData = $glLedgers[$accType->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $glLedger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(array_key_exists($glLedger->id, $slLedgers)): ?>
      <?php
      $ttlGl = 0;
      $html = '';
      $i=0;
      foreach($slLedgers[$glLedger->id] as $slLedger) {
        $amount = 0;
        if(array_key_exists($slLedger->id, $ledgers)) {
          $amount = $ledgers[$slLedger->id];
          $amount = ($slLedger->type_id==2) ? $amount->debit_amount-$amount->credit_amount : $amount->credit_amount-$amount->debit_amount;
        }
        $html .= '<tr>';
        $html .= '<td class="pl-4"><span class="pl-4">'.$slLedger->ledger_head.'</span></td>';
        $html .= '<td class="text-right">'.number_format($amount, 2).'</td>';
        $html .= '</tr>';
        $ttlGl += $amount;
      }
      $ttlAmount += $ttlGl;
      ?>
      <tr>
        <td class="pl-4"><b><?php echo e($glLedger->ledger_head); ?></b></td>
        <td class="text-right"><b><?php echo e(number_format($ttlGl, 2)); ?></b></td>
      </tr>
      <?php echo $html; ?>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php $surplusAmount = ($accType->id==4) ? $surplusAmount+$ttlAmount : $surplusAmount-$ttlAmount; ?>
  
    <tr>
      <td class="text-right"><b>Total</b></td>
      <td class="text-right"><b>
         <?php if($set_currency->currency_position==2): ?><?php echo e($set_currency->symbol); ?><?php endif; ?> 
            <?php echo e(number_format($ttlAmount, 2)); ?>

            <?php if($set_currency->currency_position==1): ?><?php echo e($set_currency->symbol); ?><?php endif; ?>
           <?php echo e($set_currency->currency_text); ?>

     
    </b></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <!-- Surplus -->
    <tr>
      <td class="text-right bg-light_1"><b>Profit/Loss (Surplus)</b></td>
      <td class="text-right bg-light_1"><b><?php echo e(number_format($surplusAmount, 2)); ?></b></td>
    </tr>
  </tbody>
</table>

</div><?php /**PATH N:\WAMPP\www\SOFTWARE\ACC-SOFTWARE-GHANA\resources\views/accounts/reports/incomeStatement/report.blade.php ENDPATH**/ ?>