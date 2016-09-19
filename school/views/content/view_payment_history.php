<div class="block"> 
    <div class="navbar block-inner block-header">
        <div class="row">
            <ul class="nav nav-pills">
                <li><p class="text-muted">Payment history </p></li>
            </ul>
        </div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <div class="tab-content">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="example">
            <thead>
                <tr>
                    <th class="hidden">Sl.</th>
                    <th>Payment Date</th>
                    <th class="hide-sm">PayerID</th>
                    <th class="hide-md">Gateway Reference</th>
                    <th>Pay Amount</th>
                    <th class="hidden-xxs">Currency</th>
                    <th class="hidden-xxs">Reference</th>
                    <th class="hidden-xxs">Student Name</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1;
            foreach ($payments as $payment) { ?>
                <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                    <td class="hidden"><?=$i;?></td>
                    <td><?=$payment->pay_date;?></td>
                    <td class="hide-sm"><?=$payment->payer_id;?></td>
                    <td class="hide-md"><?=$payment->gateway_reference;?></td>
                    <td><?=$payment->pay_amount;?></td>
                    <td class="hidden-xxs"><?=$payment->currency_code;?></td>
                    <td class="hidden-xxs"><?=$payment->payment_reference;?></td>
                    <td class="hidden-xxs"><?=$payment->user_name;?></td>
                </tr>
            <?php $i++;
            } ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
    </div>
</div><!--/span-->