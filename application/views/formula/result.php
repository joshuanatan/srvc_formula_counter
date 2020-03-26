<div class = "col-lg-12">

    <h4>Formula Result:</h4>
    <h5>Formula Name:</h5>
    <p><?php echo $detail["formula_name"];?></p>
    <h5>Formula Desc:</h5>
    <p><?php echo $detail["formula_desc"];?></p>
    <h5>Variable Passed:</h5>
    <ul>
        <?php for($a = 0; $a<count($variable); $a++):?>
        <li><?php echo $variable[$a];?></li>
        <?php endfor;?>
    </ul>
    <br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Attribute Name</th>
            <th>Result</th>
            <th>Attribute Formula</th>
            <th>Executed Formula</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($formula); $a++):?>
            <tr>
                <td><?php echo strtoupper($formula[$a]["attr"]);?></td>
                <td><?php echo $formula[$a]["answer"]." ".$formula[$a]["satuan"];?></td>
                <td><?php echo $formula[$a]["formula_ctrl"];?></td>
                <td><?php echo $formula[$a]["formula"];?></td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>