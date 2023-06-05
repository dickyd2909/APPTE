<div id="bgtable">
    <div id="botable">
        <div id="tabletop" class="clearfix">
            <div class="tabletoptit">
                Logs Visitor
            </div>
        </div>
        <div id="table">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>IP Address</th>
						<th>Tanggal</th>
						<th>Hits</th>
						<th>Online</th>
						<th>Agent</th>
                    </tr>
                </thead>
                <tbody id="post_list">
                    <?php
                        $no = 1;
                        $db = $koneksi->query("SELECT * FROM logsvisitor ORDER BY visitor_hits DESC");
                        while($dt = $db->fetch_array()){
                    ?>
                        <tr data-post-id="<?php echo $dt["visitor_id"]; ?>">
                            <td width="1%" align="center"><?= $no++; ?></td>
                            <td><?= $dt['visitor_ip'] ?></td>
							<td><?= $dt['visitor_date'] ?></td>
							<td><?= $dt['visitor_hits'] ?></td>
							<td><?= $dt['visitor_online'] ?></td>
							<td><?= $dt['visitor_agent'] ?></td>
                        </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>