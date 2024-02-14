<!-- Enroll Student -->
<div class="container mt-2 mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow" id="paymentModal">
                <div class="card-header">
                    <h5 class="text-uppercase">
                        add payment
                        <button type="button" class="close" id="closeBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <form id="save_payment" class="form">

                    <div class="card-body">
                    
                        <div class="row">
                            
                            <div class="col-12">
                                <form id="addPaymentForm">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Collection Name</th>
                                                <th>Fee</th>
                                                <th>Balance</th>
                                                <th>Payment</th>
                                            </tr>
                                        </thead>
                                        <input type="text" id="enrollment_id" hidden name="enrollment_id">
                                        <input type="text" id="schoolyear" hidden name="schoolyear">
                                        <tbody id="paymentTbody">
                                            
                                        </tbody>
                                    </table>
                                </form>


                            </div>


                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" id="closeBtn" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button> -->
                        <button type="submit" id="subBtn" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
