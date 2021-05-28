		
			<?php
			$attached = get_post_meta( get_the_ID(), 'attached_cmb2_attached_posts', true );
			foreach ( $attached as $attached_post ) {
			echo "<div class='agent-widget'>";
   			 $post = get_post( $attached_post );

   			 /* Call the metabox here */
   			 $title = get_post_meta( get_the_ID(), 'agent_title', true );
   			 $tel =  get_post_meta( get_the_ID(), 'agent_telephone', true );
   			 $mobile =  get_post_meta( get_the_ID(), 'agent_mobile', true );
   			 $email = get_post_meta( get_the_ID(), 'agent_email', true );
   			 $address = get_post_meta( get_the_ID(), 'agent_address', true );

   			 the_post_thumbnail('medium');
   			 /*
   			  * Displays or returns the title of the current post
   			  * codex: https://codex.wordpress.org/Function_Reference/the_title
   			  */
   			 echo '<div class="agent-title">';
   			 the_title("<h3 class='entry-title'>","</h3>");
   			 if(!empty( $title )) { echo "<span>" . $title . "</span>"; }

   			 echo "</div><ul class='agent-list'>";
   			 if(!empty( $tel )) { echo "<li class='tel'>" . $tel . "</li>"; }
   			 if(!empty( $mobile )) { echo "<li class='mobile'>" . $mobile . "</li>"; }
   			 if(!empty( $email )) { echo "<li class='email'>" . $email . "</li>"; }
   			 if(!empty( $address )) { echo "<li class='address'>" . $address . "</li>"; }
   			 echo "</ul> </div>";
			}
		?>