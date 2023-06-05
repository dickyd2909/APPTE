<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Logs Content	
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>History</th>
                    </tr>
                </thead>
                <tbody id="post_list">
                    <?php
                        $no = 1;
						if ($odt['admincat_id'] != 'AC001') {
							$db = $koneksi->query("SELECT * FROM logscontent WHERE admin_id = '$_SESSION[admin_id]' ORDER BY logscontent_read DESC");
						} else {
							$db = $koneksi->query("SELECT * FROM logscontent ORDER BY logscontent_read DESC");
						}
						$koneksi->query("UPDATE logscontent SET logscontent_read='0'");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr>
                            <td width="1%" align="center"><?= $no++; ?></td>
							<?php if ($dt['logscontent_read'] != 0) { ?>
								<td>
									<b><?php echo date_format(date_create($dt['postdated']), 'd/m/Y H:i:s'); ?> &bull; <?php echo $pdt["admin_username"]; ?> &bull; <?php echo $dt['logscontent_status']; ?> &bull; <?php echo $dt['logscontent_desc']; ?></b>
								</td>
							<?php }else{ ?>
								<td>
									<?php echo date_format(date_create($dt['postdated']), 'd/m/Y H:i:s'); ?> &bull; <?php echo $pdt["admin_username"]; ?> &bull; <?php echo $dt['logscontent_status']; ?> &bull; <?php echo $dt['logscontent_desc']; ?>
								</td>
							<?php } ?>
                        </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>