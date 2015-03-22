<div id="Header">
        	<div class="Menu">
        		<table width="100%">
        			<tr><td><a href="index.php">Home</a></td>
        				<td><a href="product.php"> Product</a></td>
        				<?php if ($role=="") {						
						?>
						<td><a href="register.php">Register</a></td>
						<?php }?>
        				<td><a href="testimoni.php">Testimony</a></td>
        				<?php
        				if($role=="member"){
        					?>
        					<td><a href="cart.php">Cart</a></td>
        				<?php
						}
        				?>
        				<?php 
        				if($role=="admin"){
        					?>
        					<td><a href="managemember.php">Manage Member</a></td>
        				<?php
						}
        				?>
        				<?php if($role=="member"||$role=="admin"){?>
        				<td><a href="profile.php">Profile</a></td>
        				<td><a href="transaction.php">Transaction</a></td>
        				<td><a href="logout.php">Logout</a></td>
        				<?php } ?>
        			</tr>
        		</table>
            </div>
            
        </div>