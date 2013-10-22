<?php

class ApiController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
    	
		if(!$this->_hasParam('dados'))
		{
			$erro = array('message' => "Faltando param dados","code"=>"001" );
			
			 echo Zend_Json_Encoder::encode($erro);
			
			return FALSE;
			
		}
		
        $dados = Zend_Json_Decoder::decode($this->_getParam('dados',null));
		
		if(is_array($dados)){
            $login = $dados['login'];
            $senha = $dados['senha'];

            $modelProjetos = new Application_Model_Projetos();
            $projeto = $modelProjetos->login($login, $senha);
			
            if($projeto){
                $projeto = $projeto->toArray();
				$projeto["tipo"] = "1";
                $modelMolduras = new Application_Model_Molduras();
                $molduras = $modelMolduras->listar($projeto['id']);
                if($molduras){
                    $i = 0;
                    foreach ($molduras as $value) {
                        $projeto['molduras'][$i] = "http://".$_SERVER["HTTP_HOST"]."/portal/public/molduras/".$value->moldura;
                        $i++;
                    }
                }
				if($projeto["pesquisa_id"])
				{
					$modelPesquisas = new Application_Model_Pesquisas();
	                $pesquisa = $modelPesquisas->buscaPorId($projeto["pesquisa_id"]);
	                if($pesquisa){
	                    $pesquisa = $pesquisa->toArray();
	                    $modelPerguntas = new Application_Model_Perguntas();
	                    $modelRespostas = new Application_Model_Respostas();
	                    $perguntas = $modelPerguntas->listar($pesquisa['id']);
						$pesquisa["tipo"] = "2";
	                    if($perguntas){
	                        $i = 0;
	                        foreach ($perguntas as $value) {
	                            $array = array();
	                            $respostas = $modelRespostas->listar($value->id);
	                            if($respostas){
	                                $j = 0;
	                                foreach ($respostas as $value2) {
	                                    $array[$j] = $value2->resposta;
	                                    $j++;
	                                }
	                            }
	                            
	                            $array = array("Pergunta" => $value->pergunta,"Respostas" => $array);
	                            
	                            $pesquisa['perguntas'][$i] = $array;
	                            $i++;
	                        }
	                    }
	                	$projeto["pesquisa"] = $pesquisa;
					}
				}

                echo Zend_Json_Encoder::encode($projeto);
            }else{
                $modelPesquisas = new Application_Model_Pesquisas();
                $pesquisa = $modelPesquisas->login($login, $senha);
                if($pesquisa){
                    $pesquisa = $pesquisa->toArray();
                    $modelPerguntas = new Application_Model_Perguntas();
                    $modelRespostas = new Application_Model_Respostas();
                    $perguntas = $modelPerguntas->listar($pesquisa['id']);
					$pesquisa["tipo"] = "2";
                    if($perguntas){
                        $i = 0;
                        foreach ($perguntas as $value) {
                            $array = array();
                            $respostas = $modelRespostas->listar($value->id);
                            if($respostas){
                                $j = 0;
                                foreach ($respostas as $value2) {
                                    $array[$j] = $value2->resposta;
                                    $j++;
                                }
                            }
                            
                            $array = array("Pergunta" => $value->pergunta,"Respostas" => $array);
                            
                            $pesquisa['perguntas'][$i] = $array;
                            $i++;
                        }
                    }
                }
                
                echo Zend_Json_Encoder::encode($pesquisa);
            }
        }else{
        	$erro = array('message' => "Login ou senha inválidos","code"=>"002" );
            echo Zend_Json_Encoder::encode($erro);
        }
        
    }
    
    public function inserirAction(){
        if($this->_request->isPost()){
            $dados = $this->_getParam('teste',0);
            $model = new Application_Model_Projetos();
            
            $dados['senha'] = md5($dados['senha']);
            
            $model->inserir($dados);
            echo Zend_Json_Encoder::encode($dados);
        }
    }
    
    public function listaAction(){
        $model = new Application_Model_Projetos();
        $dados = $model->listar()->toArray();
        echo Zend_Json_Encoder::encode($dados);
    }


}