<?php

function menu()
{     
	$menu='';
	$query=mysql_query("SELECT * FROM menus WHERE me_idpadre=0");     
	$menu.='<ul class="mi-menu">'; 

	
	while($resultado=mysql_fetch_assoc($query))
	{   
		$submenu=mysql_query("select * from menus where me_idpadre=".$resultado['me_codigo']." ");
		
		if(mysql_num_rows($submenu)==0)
		{
			$menu.= '<li><a href="'.$resultado["me_enlace_en"].'" target="'.$resultado["me_target"].'" title="'.$resultado["me_descri"].'">'.$resultado['me_texto_en'].'</a></li>';    
		}	
		
		else
		{
			$menu.= '<li><a href="'.$resultado["me_enlace_en"].'" target="'.$resultado["me_target"].'" title="'.$resultado["me_descri"].'">'.$resultado['me_texto_en'].'</a><ul>';  
			
			while($msubmenu=mysql_fetch_array($submenu))
			{
				$submenu2=mysql_query("select * from menus where me_idpadre=".$msubmenu['me_codigo']." ");
				
				if(mysql_num_rows($submenu)==0)
				{
					$menu.= '<li><a href="'.$msubmenu["me_enlace_en"].'" target="'.$msubmenu["me_target"].'" title="'.$msubmenu["me_descri"].'">'.$msubmenu['me_texto_en'].'</a></li>';    
				}
				else
				{
					$menu.= '<li><a href="'.$msubmenu["me_enlace_en"].'" target="'.$msubmenu["me_target"].'" title="'.$msubmenu["me_descri"].'">'.$msubmenu['me_texto_en'].'</a><ul>'; 
					
					while($msubmenu2=mysql_fetch_array($submenu2))
					{
						$menu.= '<li><a href="'.$msubmenu2["me_enlace_en"].'" target="'.$msubmenu2["me_target"].'" title="'.$msubmenu2["me_descri"].'">'.$msubmenu2['me_texto_en'].'</a></li>';   
					}
				}
				$menu.='</ul></li>';
			}
			
			$menu.='</ul></li>';
		}
	}               
	
	return $menu;
}
 
$menu=menu();
echo $menu;

echo '</ul>';

?>
