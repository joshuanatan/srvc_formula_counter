<div class = "col-lg-12">
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Attribute Name</th>
            <th>Coefficient</th>
            <th>Units</th>
            <th>Estimated Unit</th>
            <th>Estimated Price</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($rab); $a++):?>
            <tr>
                <td><?php echo strtoupper($rab[$a]["formula_attr_name"]);?></td>
                <td><?php echo $rab[$a]["koefisien"];?></td>
                <td><?php echo $rab[$a]["satuan_htg"];?></td>
                <td><?php echo $rab[$a]["jumlah_unit"];?></td>
                <td><?php echo $rab[$a]["harga_satuan"];?></td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>