<?php

	class Message{

		function addSuccessMessage($message){
			$_SESSION['message']['success'][] = $message;
		}

		function addErrorMessage($message){
			$_SESSION['message']['error'][] = $message;
		}

		function showMessage(){

			if(!empty($_SESSION['message']['success'])){
				echo "<div class='alert alert-success' style='text-align:center'>" .implode('<br>',$_SESSION['message']['success']). "</div>";
				unset($_SESSION['message']['success']);
			}

			if(!empty($_SESSION['message']['error'])){
				echo "<div class='alert alert-danger' style='text-align:center'>" .implode('<br>',$_SESSION['message']['error']). "</div>";
				unset($_SESSION['message']['error']);
			}
		}

		function messageErrorExists(){
			//Le empty renvoi true ou false , car il test si message error est vide ou non
			
			//Si le tableau est vide il renvoi false car il n'y a pas de message d'erreur
			return !empty($_SESSION['message']['error']);
		}

	}

?>