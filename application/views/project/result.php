<div class = "col-lg-12">
    <table class = "table table-bordered table-hover table-striped">
        <thead>
            <th>Attribute Name</th>
            <th>Volume</th>
            <th>Coefficient</th>
            <th>Estimated Unit</th>
            <th></th>
            <th>Unit Price</th>
            <th>Estimated Price</th>
        </thead>
        <tbody>
            <?php $formula_cat_name = "";?>
            <?php $formula_name = "";?>
            <?php $tipe_attr = "";?>
            <?php $total_rab = 0;?>
            <?php for($a = 0; $a<count($rab); $a++):?>
                <?php if(strtoupper($rab[$a]["formula_cat_name"]) != strtoupper($formula_cat_name)):?>
                    <?php $formula_cat_name = $rab[$a]["formula_cat_name"];?>
                    <tr>
                        <td colspan = 7><strong></td>
                    </tr>
                    <tr>
                        <td colspan = 7><strong><?php echo strtoupper($formula_cat_name);?></strong><br/></td>
                    </tr>
                <?php endif;?>
                <?php if(strtoupper($rab[$a]["formula_desc"]) != strtoupper($formula_name)):?>
                    <?php $formula_name = $rab[$a]["formula_desc"];?>
                    
                    <tr>
                        <td colspan = 7><strong></td>
                    </tr>
                    <tr>
                        <td colspan = 7><strong><?php echo strtoupper($formula_name);?></strong><br/></td>
                    </tr>
                    <tr>
                        <td colspan = 7><strong></td>
                    </tr>
                <?php endif;?>
                <?php if(strtoupper($rab[$a]["tipe_attr"]) != strtoupper($tipe_attr)):?>
                    <?php $tipe_attr = $rab[$a]["tipe_attr"];?>
                    <tr>
                        <td colspan = 7><strong><?php echo "BIAYA ".strtoupper($tipe_attr);?></strong><br/></td>
                    </tr>
                <?php endif;?>
            <tr>
                <td><?php echo ucwords(strtolower($rab[$a]["formula_attr_name"]));?></td>
                <td><?php echo $rab[$a]["satuan_htg"];?></td>
                <td><?php echo $rab[$a]["koefisien"];?></td>
                <td><?php echo $rab[$a]["jumlah_unit"];?></td>
                <td><?php echo $rab[$a]["satuan_attr"];?></td>
                <td><?php echo $rab[$a]["harga_satuan_attr"];?></td>
                <td><?php $total_rab += $rab[$a]["harga_satuan"];echo number_format($rab[$a]["harga_satuan"]);?></td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <hr/>
    <table class = "table table-striped table-bordered">
        <tr>
            <td style = "width:60%">Total RAB</td>
            <td style = "width:40%"><?php echo number_format($total_rab);?></td>
        </tr>
    </table>
</div>