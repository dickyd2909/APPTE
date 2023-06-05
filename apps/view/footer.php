 <div id="bgfooter">
        <div id="bofooter" class="clearfix">
            <div class="footerleft">
                <div class="footerlefttit">
                    GET IN TOUCH
                </div>
                <div class="footerleftimg">
					<?php
						$ldb = $koneksi->query("SELECT * FROM logo");
						$ldt = $ldb->fetch_array();
					?>
                    <img src="../cms/assets/images/logo/<?= $ldt['logo_gambar']; ?>" alt="<?= $ldt['logo_alt']; ?>" title="<?= $ldt['logo_title']; ?>" width="<?= $ldt['logo_lebar']; ?>" height="<?= $ldt['logo_panjang']; ?>">
                </div>
                <div class="footerleftdesc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolores explicabo totam enim nihil, eos placeat libero quis labore inventore ea? Velit odit error ullam rem nisi explicabo porro est!
                </div>
            </div> 
            <div class="footermid">
                <div class="footermidtit">
                    SUPPORT MENU
                </div>
                <div class="footermidlink">
                    <ul>
						<?php
							$mdb = $koneksi->query("SELECT * FROM menu WHERE menu_status = 'Aktif' ORDER BY menu_order ASC");
							while($mdt = $mdb->fetch_array()){
						?>
							<li><a href="#"><?= $mdt['menu_nama']; ?></a></li>
						<?php } ?>	
                    </ul>
                </div>
            </div>   
            <div class="footerright">
                <div class="footerrightit">
                    SUBSCRIBE
                </div>
                <div class="footerrightsubtit">
                    Daftarkan Email Anda Untuk Mendapatkan Info Dan Penawaran Spesial
                </div>
                <div class="footerrightinput">
                    <input type="text" class="subscribe" placeholder="Please Enter Your Email Address">
                </div>
                <div class="footerrightbtn">
                    <input type="submit" name="submit" value="Subscribe" class="btnsubs" >
                </div>
            </div>
        </div>
    </div>
    <!-- section bottom -->
    <div id="bgbot">
        <div id="bobot">
            <div class="bottit">
                Copyright &copy; 2023 - Ipsum Onlineshop All Right Reserved<br> Powered By Basdat Lanjut A01
            </div>
        </div>
    </div>
