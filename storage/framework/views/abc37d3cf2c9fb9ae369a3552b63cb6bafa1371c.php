<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contract detail')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('css-page'); ?>
    <style>
        #card-element {
            border: 1px solid #a3afbb !important;
            border-radius: 10px !important;
            padding: 10px !important;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>

    <?php if(\Auth::user()->type=='company'): ?>
        <?php if($invoice->status!=0): ?>
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                    <?php if(!empty($invoicePayment)): ?>
                        <div class="all-button-box mx-2">
                            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-url="<?php echo e(route('invoice.credit.note',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Credit Note')); ?>">
                                <?php echo e(__('Add Credit Note')); ?>

                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if($invoice->status!=4): ?>
                        <div class="all-button-box mx-2">
                            <a href="<?php echo e(route('invoice.payment.reminder',$invoice->id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><?php echo e(__('Receipt Reminder')); ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="all-button-box mx-2">
                        <a href="<?php echo e(route('invoice.resent',$invoice->id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><?php echo e(__('Resend Invoice')); ?></a>
                    </div>
                    <div class="all-button-box">
                        <a href="<?php echo e(route('invoice.pdf', Crypt::encrypt($invoice->id))); ?>" target="_blank" class="btn btn-xs btn-white btn-icon-only width-auto"><?php echo e(__('Download')); ?></a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                <div class="all-button-box mx-2">
                    <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-url="<?php echo e(route('customer.invoice.send',$invoice->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Send Invoice')); ?>">
                        <?php echo e(__('Send Mail')); ?>

                    </a>
                </div>
                <div class="all-button-box mx-2">
                    <a href="<?php echo e(route('invoice.pdf', Crypt::encrypt($invoice->id))); ?>" target="_blank" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <?php echo e(__('Download')); ?>

                    </a>
                </div>

                <?php if($invoice->getDue() > 0 && !empty($company_payment_setting) && ($company_payment_setting['is_stripe_enabled'] == 'on' || $company_payment_setting['is_paypal_enabled'] == 'on' || $company_payment_setting['is_paystack_enabled'] == 'on' || $company_payment_setting['is_flutterwave_enabled'] == 'on' || $company_payment_setting['is_razorpay_enabled'] == 'on' || $company_payment_setting['is_mercado_enabled'] == 'on' || $company_payment_setting['is_paytm_enabled'] == 'on' ||
        $company_payment_setting['is_mollie_enabled']  == 'on' || $company_payment_setting['is_paypal_enabled'] == 'on' || $company_payment_setting['is_skrill_enabled'] == 'on' || $company_payment_setting['is_coingate_enabled'] == 'on')): ?>
                    <div class="all-button-box">
                        <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-toggle="modal" data-target="#paymentModal">
                            <?php echo e(__('Pay Now')); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row invoice-title mt-2">
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                    <h2><?php echo e(__('Invoice')); ?></h2>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-right">
                                    <h3 class="invoice-number"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></h3>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <?php if(!empty($customer->billing_name)): ?>
                                    <div class="col-md-6">
                                        <small class="font-style">
                                            <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                            <?php echo e(!empty($customer->billing_name)?$customer->billing_name:''); ?><br>
                                            <?php echo e(!empty($customer->billing_phone)?$customer->billing_phone:''); ?><br>
                                            <?php echo e(!empty($customer->billing_address)?$customer->billing_address:''); ?><br>
                                            <?php echo e(!empty($customer->billing_zip)?$customer->billing_zip:''); ?><br>
                                            <?php echo e(!empty($customer->billing_city)?$customer->billing_city:'' .', '); ?> <?php echo e(!empty($customer->billing_state)?$customer->billing_state:'',', '); ?> <?php echo e(!empty($customer->billing_country)?$customer->billing_country:''); ?>

                                        </small>
                                    </div>
                                <?php endif; ?>
                                <?php if(\Utility::getValByName('shipping_display')=='on'): ?>
                                    <div class="col-md-6 text-md-right">
                                        <small>
                                            <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                            <?php echo e(!empty($customer->shipping_name)?$customer->shipping_name:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_phone)?$customer->shipping_phone:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_address)?$customer->shipping_address:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_zip)?$customer->shipping_zip:''); ?><br>
                                            <?php echo e(!empty($customer->shipping_city)?$customer->shipping_city:'' . ', '); ?> <?php echo e(!empty($customer->shipping_state)?$customer->shipping_state:'' .', '); ?>,<?php echo e(!empty($customer->shipping_country)?$customer->shipping_country:''); ?>

                                        </small>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <small>
                                        <strong><?php echo e(__('Status')); ?> :</strong><br>
                                        <?php if($invoice->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php endif; ?>
                                    </small>
                                </div>
                                <div class="col text-md-center">
                                    <small>
                                        <strong><?php echo e(__('Issue Date')); ?> :</strong><br>
                                        <?php echo e(\Auth::user()->dateFormat($invoice->issue_date)); ?><br><br>
                                    </small>
                                </div>
                                <div class="col text-md-right">
                                    <small>
                                        <strong><?php echo e(__('Due Date')); ?> :</strong><br>
                                        <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?><br><br>
                                    </small>
                                </div>

                                <?php if(!empty($customFields) && count($invoice->customField)>0): ?>
                                    <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col text-md-right">
                                            <small>
                                                <strong><?php echo e($field->name); ?> :</strong><br>
                                                <?php echo e(!empty($invoice->customField)?$invoice->customField[$field->id]:'-'); ?>

                                                <br><br>
                                            </small>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="font-weight-bold"><?php echo e(__('Product Summary')); ?></div>
                                    <small><?php echo e(__('All items here cannot be deleted.')); ?></small>
                                    <div class="table-responsive mt-2">
                                        <table class="table mb-0 table-striped">
                                            <tr>
                                                <th data-width="40" class="text-dark">#</th>
                                                <th class="text-dark"><?php echo e(__('Product')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Rate')); ?></th>
                                                <th class="text-dark"><?php echo e(__('Tax')); ?></th>
                                                <th class="text-dark"><?php if($invoice->discount_apply==1): ?><?php echo e(__('Discount')); ?><?php endif; ?></th>
                                                <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                                <th class="text-right text-dark" width="12%"><?php echo e(__('Price')); ?><br>
                                                    <small class="text-danger font-weight-bold"><?php echo e(__('before tax & discount')); ?></small>
                                                </th>
                                            </tr>
                                            <?php
                                                $totalQuantity=0;
                                                $totalRate=0;
                                                $totalTaxPrice=0;
                                                $totalDiscount=0;
                                                $taxesData=[];
                                            ?>
                                            <?php $__currentLoopData = $iteams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($iteam->tax)): ?>
                                                    <?php
                                                        $taxes=\Utility::tax($iteam->tax);
                                                        $totalQuantity+=$iteam->quantity;
                                                        $totalRate+=$iteam->price;
                                                        $totalDiscount+=$iteam->discount;
                                                        foreach($taxes as $taxe){
                                                            $taxDataPrice=\Utility::taxRate($taxe->rate,$iteam->price,$iteam->quantity);
                                                            if (array_key_exists($taxe->name,$taxesData))
                                                            {
                                                                $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                            }
                                                            else
                                                            {
                                                                $taxesData[$taxe->name] = $taxDataPrice;
                                                            }
                                                        }
                                                    ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td><?php echo e($key+1); ?></td>
                                                    <td><?php echo e(!empty($iteam->product())?$iteam->product()->name:''); ?></td>
                                                    <td><?php echo e($iteam->quantity); ?></td>
                                                    <td><?php echo e(\Auth::user()->priceFormat($iteam->price)); ?></td>
                                                    <td>

                                                        <?php if(!empty($iteam->tax)): ?>
                                                            <table>
                                                                <?php $totalTaxRate = 0;?>
                                                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $taxPrice=\Utility::taxRate($tax->rate,$iteam->price,$iteam->quantity);
                                                                        $totalTaxPrice+=$taxPrice;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo e($tax->name .' ('.$tax->rate .'%)'); ?></td>
                                                                        <td><?php echo e(\Auth::user()->priceFormat($taxPrice)); ?></td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </table>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <?php if($invoice->discount_apply==1): ?>
                                                            <?php echo e(\Auth::user()->priceFormat($iteam->discount)); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(!empty($iteam->description)?$iteam->description:'-'); ?></td>
                                                    <td class="text-right"><?php echo e(\Auth::user()->priceFormat(($iteam->price*$iteam->quantity))); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><b><?php echo e(__('Total')); ?></b></td>
                                                <td><b><?php echo e($totalQuantity); ?></b></td>
                                                <td><b><?php echo e(\Auth::user()->priceFormat($totalRate)); ?></b></td>
                                                <td><b><?php echo e(\Auth::user()->priceFormat($totalTaxPrice)); ?></b></td>
                                                <td>  <?php if($invoice->discount_apply==1): ?>
                                                        <b><?php echo e(\Auth::user()->priceFormat($totalDiscount)); ?></b>
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="text-right"><b><?php echo e(__('Sub Total')); ?></b></td>
                                                <td class="text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getSubTotal())); ?></td>
                                            </tr>
                                            <?php if($invoice->discount_apply==1): ?>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-right"><b><?php echo e(__('Discount')); ?></b></td>
                                                    <td class="text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getTotalDiscount())); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if(!empty($taxesData)): ?>
                                                <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-right"><b><?php echo e($taxName); ?></b></td>
                                                        <td class="text-right"><?php echo e(\Auth::user()->priceFormat($taxPrice)); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="blue-text text-right"><b><?php echo e(__('Total')); ?></b></td>
                                                <td class="blue-text text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getTotal())); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="text-right"><b><?php echo e(__('Paid')); ?></b></td>
                                                <td class="text-right"><?php echo e(\Auth::user()->priceFormat(($invoice->getTotal()-$invoice->getDue())-($invoice->invoiceTotalCreditNote()))); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="text-right"><b><?php echo e(__('Credit Note')); ?></b></td>
                                                <td class="text-right"><?php echo e(\Auth::user()->priceFormat(($invoice->invoiceTotalCreditNote()))); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td class="text-right"><b><?php echo e(__('Due')); ?></b></td>
                                                <td class="text-right"><?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Receipt Summary')); ?></h5>
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-dark"><?php echo e(__('Date')); ?></th>
                                <th class="text-dark"><?php echo e(__('Amount')); ?></th>
                                <th class="text-dark"><?php echo e(__('Payment Type')); ?></th>
                                <th class="text-dark"><?php echo e(__('Account')); ?></th>
                                <th class="text-dark"><?php echo e(__('Reference')); ?></th>
                                <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                <th class="text-dark"><?php echo e(__('Receipt')); ?></th>
                                <th class="text-dark"><?php echo e(__('OrderId')); ?></th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete payment invoice')): ?>
                                    <th class="text-dark"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            <?php $__empty_1 = true; $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->dateFormat($payment->date)); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($payment->amount)); ?></td>
                                    <td><?php echo e($payment->payment_type); ?></td>
                                    <td><?php echo e(!empty($payment->bankAccount)?$payment->bankAccount->bank_name.' '.$payment->bankAccount->holder_name:'--'); ?></td>
                                    <td><?php echo e(!empty($payment->reference)?$payment->reference:'--'); ?></td>
                                    <td><?php echo e(!empty($payment->description)?$payment->description:'--'); ?></td>
                                    <td><?php if(!empty($payment->receipt)): ?><a href="<?php echo e($payment->receipt); ?>" target="_blank"> <i class="fas fa-file"></i></a><?php else: ?> -- <?php endif; ?></td>
                                    <td><?php echo e(!empty($payment->order_id)?$payment->order_id:'--'); ?></td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice product')): ?>
                                        <td>
                                            <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($payment->id); ?>').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'post', 'route' => ['invoice.payment.destroy',$invoice->id,$payment->id],'id'=>'delete-form-'.$payment->id]); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="<?php echo e((Gate::check('delete invoice product') ? '9' : '8')); ?>" class="text-center text-dark"><p><?php echo e(__('No Data Found')); ?></p></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Credit Note Summary')); ?></h5>
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-dark"><?php echo e(__('Date')); ?></th>
                                <th class="text-dark" class=""><?php echo e(__('Amount')); ?></th>
                                <th class="text-dark" class=""><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('edit credit note') || Gate::check('delete credit note')): ?>
                                    <th class="text-dark"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            <?php $__empty_1 = true; $__currentLoopData = $invoice->creditNote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$creditNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Auth::user()->dateFormat($creditNote->date)); ?></td>
                                    <td class=""><?php echo e(\Auth::user()->priceFormat($creditNote->amount)); ?></td>
                                    <td class=""><?php echo e($creditNote->description); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit credit note')): ?>
                                            <a data-url="<?php echo e(route('invoice.edit.credit.note',[$creditNote->invoice,$creditNote->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Credit Note')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Credit Note')); ?>" href="#" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete credit note')): ?>
                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($creditNote->id); ?>').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => array('invoice.delete.credit.note', $creditNote->invoice,$creditNote->id),'id'=>'delete-form-'.$creditNote->id]); ?>

                                            <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <p class="text-dark"><?php echo e(__('No Data Found')); ?></p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(auth()->guard('customer')->check()): ?>
        <?php if($invoice->getDue() > 0): ?>
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel"><?php echo e(__('Add Payment')); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card bg-none card-box">
                                <section class="nav-tabs p-2">
                                    <?php if(!empty($company_payment_setting) && ($company_payment_setting['is_stripe_enabled'] == 'on' || $company_payment_setting['is_paypal_enabled'] == 'on' || $company_payment_setting['is_paystack_enabled'] == 'on' || $company_payment_setting['is_flutterwave_enabled'] == 'on' || $company_payment_setting['is_razorpay_enabled'] == 'on' || $company_payment_setting['is_mercado_enabled'] == 'on' || $company_payment_setting['is_paytm_enabled'] == 'on' ||
                            $company_payment_setting['is_mollie_enabled'] ==
                            'on' ||
                            $company_payment_setting['is_paypal_enabled'] == 'on' || $company_payment_setting['is_skrill_enabled'] == 'on' || $company_payment_setting['is_coingate_enabled'] == 'on')): ?>
                                        <ul class="nav nav-pills  mb-3" role="tablist">
                                            <?php if($company_payment_setting['is_stripe_enabled'] == 'on' && !empty($company_payment_setting['stripe_key']) && !empty($company_payment_setting['stripe_secret'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm active" data-toggle="tab" href="#stripe-payment" role="tab" aria-controls="stripe" aria-selected="true"><?php echo e(__('Stripe')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if($company_payment_setting['is_paypal_enabled'] == 'on' && !empty($company_payment_setting['paypal_client_id']) && !empty($company_payment_setting['paypal_secret_key'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#paypal-payment" role="tab" aria-controls="paypal" aria-selected="false"><?php echo e(__('Paypal')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if($company_payment_setting['is_paystack_enabled'] == 'on' && !empty($company_payment_setting['paystack_public_key']) && !empty($company_payment_setting['paystack_secret_key'])): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#paystack-payment" role="tab" aria-controls="paystack" aria-selected="false"><?php echo e(__('Paystack')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_flutterwave_enabled']) && $company_payment_setting['is_flutterwave_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#flutterwave-payment" role="tab" aria-controls="flutterwave" aria-selected="false"><?php echo e(__('Flutterwave')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_razorpay_enabled']) && $company_payment_setting['is_razorpay_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#razorpay-payment" role="tab" aria-controls="razorpay" aria-selected="false"><?php echo e(__('Razorpay')); ?></a>
                                                </li>
                                            <?php endif; ?>


                                            <?php if(isset($company_payment_setting['is_mercado_enabled']) && $company_payment_setting['is_mercado_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#mercado-payment" role="tab" aria-controls="mercado" aria-selected="false"><?php echo e(__('Mercado')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_paytm_enabled']) && $company_payment_setting['is_paytm_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#paytm-payment" role="tab" aria-controls="paytm" aria-selected="false"><?php echo e(__('Paytm')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_mollie_enabled']) && $company_payment_setting['is_mollie_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#mollie-payment" role="tab" aria-controls="mollie" aria-selected="false"><?php echo e(__('Mollie')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_skrill_enabled']) && $company_payment_setting['is_skrill_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#skrill-payment" role="tab" aria-controls="skrill" aria-selected="false"><?php echo e(__('Skrill')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_coingate_enabled']) && $company_payment_setting['is_coingate_enabled'] == 'on'): ?>
                                                <li class="nav-item mb-2">
                                                    <a class="btn btn-outline-primary btn-sm ml-1" data-toggle="tab" href="#coingate-payment" role="tab" aria-controls="coingate" aria-selected="false"><?php echo e(__('Coingate')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                        </ul>
                                    <?php endif; ?>
                                        <div class="tab-content">
                                            <?php if(!empty($company_payment_setting) && ($company_payment_setting['is_stripe_enabled'] == 'on' && !empty($company_payment_setting['stripe_key']) && !empty($company_payment_setting['stripe_secret']))): ?>
                                                <div class="tab-pane fade active show" id="stripe-payment" role="tabpanel" aria-labelledby="stripe-payment">
                                                    <form method="post" action="<?php echo e(route('customer.invoice.payment',$invoice->id)); ?>" class="require-validation" id="payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <div class="custom-radio">
                                                                    <label class="font-16 font-weight-bold"><?php echo e(__('Credit / Debit Card')); ?></label>
                                                                </div>
                                                                <p class="mb-0 pt-1 text-sm"><?php echo e(__('Safe money transfer using your bank account. We support Mastercard, Visa, Discover and American express.')); ?></p>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="card-name-on"><?php echo e(__('Name on card')); ?></label>
                                                                    <input type="text" name="name" id="card-name-on" class="form-control required" placeholder="<?php echo e(\Auth::user()->name); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div id="card-element">

                                                                </div>
                                                                <div id="card-errors" role="alert"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <br>
                                                                <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                    <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="error" style="display: none;">
                                                                    <div class='alert-danger alert'><?php echo e(__('Please correct the errors and try again.')); ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <button class="btn btn-sm btn-primary rounded-pill" type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(!empty($company_payment_setting) &&  ($company_payment_setting['is_paypal_enabled'] == 'on' && !empty($company_payment_setting['paypal_client_id']) && !empty($company_payment_setting['paypal_secret_key']))): ?>
                                                <div class="tab-pane fade " id="paypal-payment" role="tabpanel" aria-labelledby="paypal-payment">
                                                    <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form" action="<?php echo e(route('customer.pay.with.paypal',$invoice->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                    <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">
                                                                    <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-amount" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <button class="btn btn-sm btn-primary rounded-pill" name="submit" type="submit"><?php echo e(__('Make Payment')); ?></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_paystack_enabled']) && $company_payment_setting['is_paystack_enabled'] == 'on' && !empty($company_payment_setting['paystack_public_key']) && !empty($company_payment_setting['paystack_secret_key'])): ?>
                                                <div class="tab-pane fade " id="paystack-payment" role="tabpanel" aria-labelledby="paypal-payment">
                                                    <form class="w3-container w3-display-middle w3-card-4" method="POST" id="paystack-payment-form" action="<?php echo e(route('customer.invoice.pay.with.paystack')); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input class="btn btn-sm btn-primary rounded-pill" id="pay_with_paystack" type="button" value="<?php echo e(__('Make Payment')); ?>">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_flutterwave_enabled']) && $company_payment_setting['is_flutterwave_enabled'] == 'on' && !empty($company_payment_setting['paystack_public_key']) && !empty($company_payment_setting['paystack_secret_key'])): ?>
                                                <div class="tab-pane fade " id="flutterwave-payment" role="tabpanel" aria-labelledby="paypal-payment">
                                                    <form role="form" action="<?php echo e(route('customer.invoice.pay.with.flaterwave')); ?>" method="post" class="require-validation" id="flaterwave-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input class="btn btn-sm btn-primary rounded-pill" id="pay_with_flaterwave" type="button" value="<?php echo e(__('Make Payment')); ?>">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_razorpay_enabled']) && $company_payment_setting['is_razorpay_enabled'] == 'on'): ?>
                                                <div class="tab-pane fade " id="razorpay-payment" role="tabpanel" aria-labelledby="paypal-payment">
                                                    <form role="form" action="<?php echo e(route('customer.invoice.pay.with.razorpay')); ?>" method="post" class="require-validation" id="razorpay-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input class="btn btn-sm btn-primary rounded-pill" id="pay_with_razorpay" type="button" value="<?php echo e(__('Make Payment')); ?>">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_mercado_enabled']) && $company_payment_setting['is_mercado_enabled'] == 'on'): ?>
                                                <div class="tab-pane fade " id="mercado-payment" role="tabpanel" aria-labelledby="mercado-payment">
                                                    <form role="form" action="<?php echo e(route('customer.invoice.pay.with.mercado')); ?>" method="post" class="require-validation" id="mercado-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input type="submit" id="pay_with_mercado" value="<?php echo e(__('Make Payment')); ?>" class="btn btn-sm btn-primary rounded-pill">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_paytm_enabled']) && $company_payment_setting['is_paytm_enabled'] == 'on'): ?>
                                                <div class="tab-pane fade" id="paytm-payment" role="tabpanel" aria-labelledby="paytm-payment">
                                                    <form role="form" action="<?php echo e(route('customer.invoice.pay.with.paytm')); ?>" method="post" class="require-validation" id="paytm-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="flaterwave_coupon" class=" text-dark"><?php echo e(__('Mobile Number')); ?></label>
                                                                <input type="text" id="mobile" name="mobile" class="form-control mobile" data-from="mobile" placeholder="<?php echo e(__('Enter Mobile Number')); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input type="submit" id="pay_with_paytm" value="<?php echo e(__('Make Payment')); ?>" class="btn btn-sm btn-primary rounded-pill">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_mollie_enabled']) && $company_payment_setting['is_mollie_enabled'] == 'on'): ?>
                                                <div class="tab-pane fade " id="mollie-payment" role="tabpanel" aria-labelledby="mollie-payment">
                                                    <form role="form" action="<?php echo e(route('customer.invoice.pay.with.mollie')); ?>" method="post" class="require-validation" id="mollie-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input type="submit" id="pay_with_mollie" value="<?php echo e(__('Make Payment')); ?>" class="btn btn-sm btn-primary rounded-pill">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_skrill_enabled']) && $company_payment_setting['is_skrill_enabled'] == 'on'): ?>
                                                <div class="tab-pane fade " id="skrill-payment" role="tabpanel" aria-labelledby="skrill-payment">
                                                    <form role="form" action="<?php echo e(route('customer.invoice.pay.with.skrill')); ?>" method="post" class="require-validation" id="skrill-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <?php
                                                            $skrill_data = [
                                                                'transaction_id' => md5(date('Y-m-d') . strtotime('Y-m-d H:i:s') . 'user_id'),
                                                                'user_id' => 'user_id',
                                                                'amount' => 'amount',
                                                                'currency' => 'currency',
                                                            ];
                                                            session()->put('skrill_data', $skrill_data);

                                                        ?>
                                                        <div class="form-group mt-3">
                                                            <input type="submit" id="pay_with_skrill" value="<?php echo e(__('Make Payment')); ?>" class="btn btn-sm btn-primary rounded-pill">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                            <?php if(isset($company_payment_setting['is_coingate_enabled']) && $company_payment_setting['is_coingate_enabled'] == 'on'): ?>
                                                <div class="tab-pane fade " id="coingate-payment" role="tabpanel" aria-labelledby="coingate-payment">
                                                    <form role="form" action="<?php echo e(route('customer.invoice.pay.with.coingate')); ?>" method="post" class="require-validation" id="coingate-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="invoice_id" value="<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($invoice->id)); ?>">

                                                        <div class="form-group col-md-12">
                                                            <label for="amount"><?php echo e(__('Amount')); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-prepend"><span class="input-group-text"><?php echo e(Utility::getValByName('site_currency')); ?></span></span>
                                                                <input class="form-control" required="required" min="0" name="amount" type="number" value="<?php echo e($invoice->getDue()); ?>" min="0" step="0.01" max="<?php echo e($invoice->getDue()); ?>" id="amount">

                                                            </div>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <input type="submit" id="pay_with_coingate" value="<?php echo e(__('Make Payment')); ?>" class="btn btn-sm btn-primary rounded-pill">
                                                        </div>

                                                    </form>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/contracts/show.blade.php ENDPATH**/ ?>