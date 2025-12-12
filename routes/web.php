<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Rotas Publicas Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('login');
})->name('login2');



//ROTA DE LOGOUT
Route::post('/logout2', [App\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])->name('logout2');



Route::get('/usuarios/primeiroacesso', [App\Http\Controllers\UsuariosController::class, 'primeiroAcesso'])->name('usuarios.primeiroacesso')->middleware(['auth:sanctum', config('jetstream.auth_session')]);
Route::post('/usuarios/atualizarsenha', [App\Http\Controllers\UsuariosController::class, 'atualizarSenha'])->name('usuarios.atualizarsenha')->middleware(['auth:sanctum', config('jetstream.auth_session')]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'primeiro.acesso'
])->group(function () {

    //dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    /*
    |--------------------------------------------------------------------------
    | Rotas para gerencias de perfil
    |--------------------------------------------------------------------------
    */
    Route::get('/perfil',          [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/perfil/update',  [App\Http\Controllers\PerfilController::class, 'update'])->name('perfil.update');
    Route::post('/perfil/store',   [App\Http\Controllers\PerfilController::class, 'store'])->name('perfil.store');
    Route::get('/perfil/alterarsenha',  [App\Http\Controllers\PerfilController::class, 'alterarSenha'])->name('alterarsenha');
    Route::post('/perfil/updatepassword',  [App\Http\Controllers\PerfilController::class, 'updatePassword'])->name('perfil.updatepassword');


    /*
    |--------------------------------------------------------------------------
    | Rotas dos corpos
    |--------------------------------------------------------------------------
    */

    Route::get('/corpos',           [App\Http\Controllers\CorpoController::class, 'index'])->name('corpos.index');
    Route::get('/corpos/create',    [App\Http\Controllers\CorpoController::class, 'create'])->name('corpos.create');
    Route::get('/corpos/edit/{id}',    [App\Http\Controllers\CorpoController::class, 'edit'])->name('corpos.edit');
    Route::post('/corpos/update/{id}',    [App\Http\Controllers\CorpoController::class, 'update'])->name('corpos.update');
    Route::post('/corpos/atribuirvo',    [App\Http\Controllers\CorpoController::class, 'atribuirvo'])->name('corpos.atribuirvo');
    Route::post('/corpos/encaminharliga',    [App\Http\Controllers\CorpoController::class, 'encaminharLiga'])->name('corpos.encaminharliga');
    Route::post('/corpos/encaminharitep',    [App\Http\Controllers\CorpoController::class, 'encaminharitep'])->name('corpos.encaminharitep');
    Route::post('/corpos/devolvercorpo',    [App\Http\Controllers\CorpoController::class, 'devolverCorpo'])->name('corpos.devolvercorpo');
    Route::post('/corpos/store',    [App\Http\Controllers\CorpoController::class, 'store'])->name('corpos.store');
    Route::get('/corpos/{id}',      [App\Http\Controllers\CorpoController::class, 'show'])->name('corpos.show');
    Route::post('/corpos/recebercorpo/{id}',      [App\Http\Controllers\CorpoController::class, 'receberCorpo'])->name('corpos.recebercorpo');
    Route::post('/corpos/medicoexterno/inserir', [App\Http\Controllers\CorpoController::class, 'inserirMedicoExterno'])->name('corpos.inserir_medico_externo');
    Route::get('/corpos/medicoexterno/{id}', [App\Http\Controllers\CorpoController::class, 'medicoExterno'])->name('corpos.medicoexterno');
    Route::get('/corpos/responsavelcorpo/{id}', [App\Http\Controllers\CorpoController::class, 'adicionarResponsavelCorpo'])->name('corpos.responsavelcorpo');
    Route::post('/corpos/responsavelcorpo/store', [App\Http\Controllers\CorpoController::class, 'adicionarResponsavelCorpoStore'])->name('corpos.responsavelcorpostore');
    Route::post('/corpos/destroy/{id}',    [App\Http\Controllers\CorpoController::class, 'destroy'])->name('corpos.destroy');
    /*
    |--------------------------------------------------------------------------
    | Rotas dos laudos
    |--------------------------------------------------------------------------
    */

    Route::get('/laudos',           [App\Http\Controllers\LaudoController::class, 'index'])->name('laudos.index');
    Route::get('/laudos/show/{id?}',    [App\Http\Controllers\LaudoController::class, 'show'])->name('laudos.show');
    Route::get('/laudos/selecionar-corpo',    [App\Http\Controllers\LaudoController::class, 'selecionarCorpo'])->name('laudos.selecionar-corpo');
    Route::get('/laudos/create/{id?}',    [App\Http\Controllers\LaudoController::class, 'create'])->name('laudos.create');
    Route::post('/laudos/store/{id?}',    [App\Http\Controllers\LaudoController::class, 'store'])->name('laudos.store');
    Route::get('/laudos/edit/{id?}',    [App\Http\Controllers\LaudoController::class, 'edit'])->name('laudos.edit');
    Route::post('/laudos/update',    [App\Http\Controllers\LaudoController::class, 'update'])->name('laudos.update');
    Route::get('/laudos/informacoes-medicas/{id?}',      [App\Http\Controllers\LaudoController::class, 'informacoesMedicas'])->name('laudos.informacoes_medicas');
    Route::post('/laudos/informacoes-medicas/inserir/{id}',      [App\Http\Controllers\LaudoController::class, 'inserirInformacoesMedicas'])->name('laudos.inserir_informacoes_medicas');
    Route::get('/laudos/download/{id}', [App\Http\Controllers\LaudoController::class, 'download_laudo'])->name('laudos.download');

    /*
    |--------------------------------------------------------------------------
    | Rotas dos exames
    |--------------------------------------------------------------------------
    */

    Route::get('/exames', [App\Http\Controllers\ExameController::class, 'index'])->name('exames.index');
    Route::get('/exames/solicitar', [App\Http\Controllers\ExameController::class, 'create'])->name('exames.create');
    Route::post('/exames/store', [App\Http\Controllers\ExameController::class, 'store'])->name('exames.store');
    Route::get('/exames/show/{id}', [App\Http\Controllers\ExameController::class, 'show'])->name('exames.show');
    Route::get('/exames/responder/{id}', [App\Http\Controllers\ExameController::class, 'responderExame'])->name('exames.responder');
    Route::post('/exames/documentosupload', [App\Http\Controllers\ExameController::class, 'anexarDocumentos'])->name('exames.documentosupload');
    Route::post('/exames/resposta/store', [App\Http\Controllers\ExameController::class, 'storeResposta'])->name('exames.respostastore');

    /*
    |--------------------------------------------------------------------------
    | Rotas dos responsáveis
    |--------------------------------------------------------------------------
    */

    Route::get('/responsaveis',             [App\Http\Controllers\ResponsavelController::class, 'index'])->name('responsaveis.index');
    // Route::get('/responsaveis/create',      [App\Http\Controllers\ResponsavelController::class, 'create'])->name('responsaveis.create');
    // Route::post('/responsaveis/store',      [App\Http\Controllers\ResponsavelController::class, 'store'])->name('responsaveis.store');
    Route::get('/responsaveis/{id}',        [App\Http\Controllers\ResponsavelController::class, 'show'])->name('responsaveis.show');

    /*
    |--------------------------------------------------------------------------
    | Rotas das entrevistas
    |--------------------------------------------------------------------------
    */

    Route::get('/entrevistas', [App\Http\Controllers\EntrevistaController::class, 'index'])->name('entrevistas.index');
    Route::get('/entrevistas/show/{id?}',    [App\Http\Controllers\EntrevistaController::class, 'show'])->name('entrevistas.show');
    Route::get('/entrevistas/selecionar-corpo',    [App\Http\Controllers\EntrevistaController::class, 'selecionarCorpo'])->name('entrevistas.selecionar-corpo');
    Route::get('/entrevistas/create/{id?}',    [App\Http\Controllers\EntrevistaController::class, 'create'])->name('entrevistas.create');
    Route::post('/entrevistas/store', [App\Http\Controllers\EntrevistaController::class, 'store'])->name('entrevistas.store');
    Route::get('/entrevistas/edit/{id?}',    [App\Http\Controllers\EntrevistaController::class, 'edit'])->name('entrevistas.edit');
    Route::post('/entrevistas/update',    [App\Http\Controllers\EntrevistaController::class, 'update'])->name('entrevistas.update');

    /*
    |--------------------------------------------------------------------------
    | Rotas de documentos Geral
    |--------------------------------------------------------------------------
    */

    Route::get('/documentos/listardocumentos/{papel?}/{tipo?}/{corpoid?}',    [App\Http\Controllers\DocumentoController::class, 'listarDocumentos'])->name('documentos.listardocumentos');
    Route::get('/documentos/deletararquivo/{id?}',    [App\Http\Controllers\DocumentoController::class, 'deletarArquivo'])->name('documentos.deletararquivo');


    /*
    |--------------------------------------------------------------------------
    | Rotas documentos recepcao
    |--------------------------------------------------------------------------
    */

    Route::get('/documentos/recepcao',           [App\Http\Controllers\DocumentosRecepcaoController::class, 'index'])->name('documentos_recepcao.index');
    Route::get('/documentos/recepcao/{id?}',    [App\Http\Controllers\DocumentosRecepcaoController::class, 'list'])->name('documentos_recepcao.list');
    Route::post('/documentos/recepcao/{id?}/upload',    [App\Http\Controllers\DocumentosRecepcaoController::class, 'upload'])->name('documentos_recepcao.upload');
    Route::get('/documentos/recepcao/encaminhamento/{id?}/info-adicional',    [App\Http\Controllers\DocumentosRecepcaoController::class, 'encaminhamentoInfoAdicional'])->name('documentos_recepcao_encaminhamento.info_adicional');
    Route::get('/documentos/recepcao/termo-responsabilidade/{id?}/info-adicional',    [App\Http\Controllers\DocumentosRecepcaoController::class, 'termoResponsabilidadeInfoAdicional'])->name('documentos_recepcao_termo_responsabilidade.info_adicional');

    /*
    |--------------------------------------------------------------------------
    | Rotas PDFs dos documentos da recepcao
    |--------------------------------------------------------------------------
    */

    Route::get('/documentos/recepcao/pdf/recebimentodecorpo/{id?}',    [App\Http\Controllers\RecepcaoPDFController::class, 'gerarDocumentoRecebimentoDeCorpo'])->name('documentos_recepcao.gerarDocumentoRecebimentoDeCorpo');
    Route::get('/documentos/recepcao/pdf/declaracao-retirada-corpo-e-declaracao-obito/{id?}/info-adicional',    [App\Http\Controllers\DocumentosRecepcaoController::class, 'declaracaoRetiradaCorpoInfoAdicional'])->name('documentos_recepcao.gerarDeclaracaoRetiradaDoCorpo.info_adicional');
    Route::post('/documentos/recepcao/pdf/declaracao-retirada-corpo-e-declaracao-obito/{id?}',    [App\Http\Controllers\RecepcaoPDFController::class, 'gerarDeclaracaoRetiradaDoCorpo'])->name('documentos_recepcao.gerarDeclaracaoRetiradaDoCorpo');
    Route::get('/documentos/recepcao/pdf/encaminhamento-iml/{id?}/info-adicional',    [App\Http\Controllers\DocumentosRecepcaoController::class, 'encaminhamentoIMLInfoAdicional'])->name('documentos_recepcao.gerarEncaminhamentoIML.info_adicional');
    Route::post('/documentos/recepcao/pdf/encaminhamento-iml/{id?}',    [App\Http\Controllers\RecepcaoPDFController::class, 'gerarEncaminhamentoIML'])->name('documentos_recepcao.gerarEncaminhamentoIML');
    Route::post('/documentos/recepcao/pdf/encaminhamento',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarEncaminhamento'])->name('documentos_recepcao.gerarEncaminhamento');
    Route::post('/documentos/recepcao/pdf/termo-responsabilidade/{id?}',    [App\Http\Controllers\RecepcaoPDFController::class, 'gerarTermoResponsabilidade'])->name('documentos_recepcao.gerarTermoResponsabilidade');

    /*
    |--------------------------------------------------------------------------
    | Rotas documentos do serviço social
    |--------------------------------------------------------------------------
    */

    Route::get('/documentos/servico-social',           [App\Http\Controllers\DocumentosServicoSocialController::class, 'index'])->name('documentos_servico_social.index');
    Route::get('/documentos/servico-social/{id?}',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'list'])->name('documentos_servico_social.list');
    Route::get('/documentos/servico-social/encaminhamento/{id?}/info-adicional',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'encaminhamentoInfoAdicional'])->name('documentos_servico_social_encaminhamento.info_adicional');
    Route::get('/documentos/servico-social/encaminhamento-defensoria/{id?}/info-adicional',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'encaminhamentoDefensoriaInfoAdicional'])->name('documentos_servico_social_encaminhamento_defensoria.info_adicional');
    Route::get('/documentos/servico-social/encaminhamento-lacen/{id?}/info-adicional',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'encaminhamentoLacenInfoAdicional'])->name('documentos_servico_social_encaminhamento_lacen.info_adicional');
    Route::get('/documentos/servico-social/declaracao-grau-parentesco/{id?}/info-adicional',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'declaracaoGrauParentescoInfoAdicional'])->name('documentos_servico_social_grau_parentesco.info_adicional');
    Route::get('/documentos/servico-social/pdf/tcle/{id?}/info-adicional',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'tcleInfoAdicional'])->name('documentos_servico_social.tcleInfoAdicional');
    Route::get('/documentos/medico/pdf/ficha-inca/{id?}/info-adicional',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'fichaIncaInfoAdicional'])->name('documentos_medico.fichaIncaInfoAdicional');


    /*
    |--------------------------------------------------------------------------
    | Rotas PDFs dos documentos do serviço social
    |--------------------------------------------------------------------------
    */

    Route::get('/documentos/servico-social/pdf/tcle/{id?}/{medico?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarDocumentoTCLE'])->name('documentos_servico_social.gerarDocumentoTCLE');
    Route::get('/documentos/servico-social/pdf/laudo/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarLaudo'])->name('documentos_servico_social.gerarLaudo');
    Route::get('/documentos/servico-social/pdf/termo-responsabilidade/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarTermoResponsabilidade'])->name('documentos_servico_social.gerarTermoResponsabilidade');
    Route::get('/documentos/servico-social/pdf/declaracao-de-comparecimento/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarDeclaracaoDeComparecimento'])->name('documentos_servico_social.gerarDeclaracaoDeComparecimento');
    Route::post('/documentos/servico-social/pdf/declaracao-grau-de-parentesco/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarDeclaracaoGrauDeParentesco'])->name('documentos_servico_social.gerarDeclaracaoGrauDeParentesco');
    Route::get('/documentos/servico-social/pdf/termo-nao-autorizacao-autopsia/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarTermoNaoAutorizacaoAutopsia'])->name('documentos_servico_social.gerarTermoNaoAutorizacaoAutopsia');
    Route::get('/documentos/servico-social/pdf/declaracao-posse-corpo/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarDeclaracaoPosseCorpo'])->name('documentos_servico_social.gerarDeclaracaoPosseCorpo');
    Route::get('/documentos/servico-social/pdf/termo-consentimento-familiar-autopsia-verbal/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarTermoConsentimentoFamiliarAutopsiaVerbal'])->name('documentos_servico_social.gerarTermoConsentimentoFamiliarAutopsiaVerbal');
    Route::post('/documentos/servico-social/pdf/encaminhamento-defensoria',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarEncaminhamentoDefensoria'])->name('documentos_servico_social.gerarEncaminhamentoDefensoria');
    Route::post('/documentos/servico-social/pdf/encaminhamento-material-lacen',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarEncaminhamentoMaterialLacen'])->name('documentos_servico_social.gerarEncaminhamentoMaterialLacen');
    Route::post('/documentos/servico-social/pdf/encaminhamento',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarEncaminhamento'])->name('documentos_servico_social.gerarEncaminhamento');



    /*
    |--------------------------------------------------------------------------
    | Rotas PDFs dos documentos do médico
    |--------------------------------------------------------------------------
    */
    Route::get('/documentos/medico',           [App\Http\Controllers\DocumentosMedicoController::class, 'index'])->name('documentos_medico.index');
    Route::get('/documentos/medico/{id?}',    [App\Http\Controllers\DocumentosMedicoController::class, 'list'])->name('documentos_medico.list');
    Route::get('/documentos/medico/encaminhamento-lacen/{id?}/info-adicional',    [App\Http\Controllers\DocumentosServicoSocialController::class, 'encaminhamentoLacenInfoAdicional'])->name('documentos_medico_encaminhamento_lacen.info_adicional');
    Route::post('/documentos/medico/pdf/encaminhamento-material-lacen',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarEncaminhamentoMaterialLacen'])->name('documentos_medico.gerarEncaminhamentoMaterialLacen');
    Route::get('/documentos/medico/pdf/termo-nao-autorizacao-autopsia/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarTermoNaoAutorizacaoAutopsia'])->name('documentos_medico.gerarTermoNaoAutorizacaoAutopsia');
    Route::post('/documentos/medico/pdf/ficha-inca',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarFichaInca'])->name('documentos_medico.gerarFichaInca');
    Route::get('/documentos/medico/pdf/gerarTermoReconhecimentoCadaver/{id?}',    [App\Http\Controllers\ServicoSocialPDFController::class, 'gerarTermoReconhecimentoCadaver'])->name('documentos_medico.gerarTermoReconhecimentoCadaver');

    /*
    |--------------------------------------------------------------------------
    | Rotas das Funerárias
    |--------------------------------------------------------------------------
    */
    Route::get('/funerarias',             [App\Http\Controllers\FunerariaController::class, 'index'])->name('funerarias.index');
    Route::get('/funerarias/create',      [App\Http\Controllers\FunerariaController::class, 'create'])->name('funerarias.create');
    Route::post('/funerarias/store',      [App\Http\Controllers\FunerariaController::class, 'store'])->name('funerarias.store');
    Route::get('/funerarias/edit/{id}',   [App\Http\Controllers\FunerariaController::class, 'edit'])->name('funerarias.edit');
    Route::put('/funerarias/update/{id}', [App\Http\Controllers\FunerariaController::class, 'update'])->name('funerarias.update');
    Route::post('/funerarias/destroy',    [App\Http\Controllers\FunerariaController::class, 'destroy'])->name('funerarias.destroy');

    /*
    |--------------------------------------------------------------------------
    | Rotas declaração de óbito
    |--------------------------------------------------------------------------
    */
    Route::get('/documentos/declaracao-obito/{id?}', [App\Http\Controllers\DeclaracaoObitoController::class, 'index'])->name('declaracao_obito.index');


    /*
    |--------------------------------------------------------------------------
    | Rotas para gerencias de Usuários
    |--------------------------------------------------------------------------
    */
    Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('usuarios.index');

    Route::get('/usuarios/create', [App\Http\Controllers\UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios/store', [App\Http\Controllers\UsuariosController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/edit/{id}', [App\Http\Controllers\UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/update/{id}', [App\Http\Controllers\UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('/usuarios/show/{id}', [App\Http\Controllers\UsuariosController::class, 'show'])->name('usuarios.show');
    Route::post('/usuarios/destroy', [App\Http\Controllers\UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/usuarios/desativados', [App\Http\Controllers\UsuariosController::class, 'desativados'])->name('usuarios.desativados');
    Route::post('/usuarios/ativar', [App\Http\Controllers\UsuariosController::class, 'ativar'])->name('usuarios.ativar');
    Route::post('/usuarios/resetarsenha', [App\Http\Controllers\UsuariosController::class, 'resetarSenha'])->name('usuarios.resetarsenha');

    /*
    |--------------------------------------------------------------------------
    | Rotas para gerencias de Relatórios
    |--------------------------------------------------------------------------
    */

    Route::get('/relatorios', [App\Http\Controllers\RelatorioController::class, 'index'])->name('relatorios.index');
    Route::post('/relatorios', [App\Http\Controllers\RelatorioController::class, 'index'])->name('relatorios.indexFiltrado');
    Route::get('/relatorios/obitos-fetais', [App\Http\Controllers\RelatorioController::class, 'viewRelatorioObitosFetais'])->name('relatorios.obitos-fetais');
    Route::post('/relatorios/obitos-fetais', [App\Http\Controllers\RelatorioController::class, 'viewrelatorioObitosFetais'])->name('relatorios.obitos-fetaisFiltrado');
    Route::get('relatorios/obitos-funerarias', [App\Http\Controllers\RelatorioController::class, 'viewRelatorioObitosFunerarias'])->name('relatorios.obitos-funerarias');
    Route::post('relatorios/obitos-funerarias', [App\Http\Controllers\RelatorioController::class, 'viewRelatorioObitosFunerarias'])->name('relatorios.obitos-funerariasFiltrado');

    /*
    |--------------------------------------------------------------------------
    | Rotas dos PDFs dos gráficos
    |--------------------------------------------------------------------------
    */

    Route::post('/relatorio/geral', [App\Http\Controllers\RelatorioController::class, 'relatorioGeral'])->name('relatorios.geral');
    Route::post('/relatorio/gerar-obitosfetais', [App\Http\Controllers\RelatorioController::class, 'relatorioObitosFetais'])->name('relatorios.gerar-obitosfetais');
    Route::post('/relatorio/gerar-obitosfunerarias', [App\Http\Controllers\RelatorioController::class, 'relatorioObitosFunerarias'])->name('relatorios.gerar-obitosfunerarias');

    /*
    |--------------------------------------------------------------------------
    | Rotas para gerencias de permissoes
    |--------------------------------------------------------------------------
    */
    Route::get('/permissoes', [App\Http\Controllers\PermissoesController::class, 'index'])->name('permissoes.index');

    /*
    |--------------------------------------------------------------------------
    | Rotas para gerencias de papeis e permissoes
    |--------------------------------------------------------------------------
    */
    Route::get('/papeisPermissoes', [App\Http\Controllers\PapeisPermissoesController::class, 'index'])->name('papeisPermissoes.index');
    Route::get('/papeisPermissoes/edit/{id}', [App\Http\Controllers\PapeisPermissoesController::class, 'edit'])->name('papeisPermissoes.edit');
    Route::put('/papeisPermissoes/update', [App\Http\Controllers\PapeisPermissoesController::class, 'update'])->name('papeisPermissoes.update');
    Route::post('/papeisPermissoes/store', [App\Http\Controllers\PapeisPermissoesController::class, 'store'])->name('papeisPermissoes.store');
    Route::post('/papeisPermissoes/destroy', [App\Http\Controllers\PapeisPermissoesController::class, 'destroy'])->name('papeisPermissoes.destroy');

    /*
    |--------------------------------------------------------------------------
    | Rotas para gerencias de Auditoria
    |--------------------------------------------------------------------------
    */
    Route::get('/logs', [App\Http\Controllers\AuditoriaController::class, 'index'])->name('auditoria.logs');
    Route::get('/auditoria/detalhes/{id}', [App\Http\Controllers\AuditoriaController::class, 'show'])->name('autoria.logs.detalhes');

    /*
    |--------------------------------------------------------------------------
    | Rotas para estilizar o tema
    |--------------------------------------------------------------------------
    */
    Route::get('/alterartema', function (Request $request) {
        $dark = $request->session()->get('isdark', false);
        $request->session()->put('isdark', !$dark);
    })->name('alterar.tema');

    /*
    |--------------------------------------------------------------------------
    | Rotas de API
    |--------------------------------------------------------------------------
    */

    Route::post('/api/verificaridentidade',    [App\Http\Controllers\ApiController::class, 'verificarIdentidade'])->name('usuario.verificaridentidade');
    Route::get('/api/buscarcid10/{pesquisa?}',         [App\Http\Controllers\ApiController::class, 'pesquisarCID10'])->name('cid10.pesquisa');
    Route::get('/api/buscarcid10/{pesquisa?}',         [App\Http\Controllers\ApiController::class, 'pesquisarCID10'])->name('cid10.pesquisa');
    Route::post('/api/getdashboard',         [App\Http\Controllers\ApiController::class, 'getDashboardFiltrado'])->name('api.getdashboard');
    Route::post('/api/createfuneraria',         [App\Http\Controllers\FunerariaController::class, 'createFunerariaAPI'])->name('funerarias.createFuneraria');
    Route::get('/api/getfunerariasapi',         [App\Http\Controllers\FunerariaController::class, 'getFunerariasAPI'])->name('funerarias.getFunerariasAPI');
    Route::get('/api/buscarocupacao/{term?}',         [App\Http\Controllers\ApiController::class, 'buscarOcupacao'])->name('api.buscarocupacao');

    /*
    |--------------------------------------------------------------------------
    | Rotas da API de Gráficos
    |--------------------------------------------------------------------------
    */

    Route::post('/api/grafico/totalmeses',         [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoMeses'])->name('graficos.totalmeses');
    Route::post('/api/grafico/totalmesesarea',         [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoMesesArea'])->name('graficos.totalmesesarea');
    Route::post('/api/grafico/faixaetaria',         [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoFaixaEtaria'])->name('graficos.faixaetaria');
    Route::post('/api/grafico/localocorrencia',         [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoLocalOcorrencia'])->name('graficos.localocorrencia');
    Route::post('/api/grafico/obitosocupacao',         [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoOcupacao'])->name('graficos.obitosocupacao');
    Route::post('/api/grafico/semanasgestacao',         [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoSemanasGestacao'])->name('graficos.semanasgestacao');
    Route::post('/api/grafico/tipoParto',        [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoTipoParto'])->name('graficos.tipoparto');
    Route::post('/api/grafico/obitosFuneraria',       [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoObitosPorFuneraria'])->name('graficos.obitosfuneraria');
    Route::post('/api/grafico/tipoTransporte',      [App\Http\Controllers\ApiGraficoController::class, 'gerarGraficoTipoTransporte'])->name('graficos.tipotransporte');
    /*
    |--------------------------------------------------------------------------
    | Rotas de notificações
    |--------------------------------------------------------------------------
    */
    Route::get('/notificacoes', [App\Http\Controllers\NotificationController::class, 'index'])->name('notificacoes.index');
    Route::get('/notificacoes/countnotifications', [App\Http\Controllers\NotificationController::class, 'countNotifications'])->name('notificacoes.countnotifications');
    Route::get('/notificacoes/markread/{id}', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notificacoes.markread');
    Route::get('/notificacoes/markallread', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notificacoes.markallread');




    Route::get('/manual-do-sistema', function () {
        return response()->file(
            storage_path('app/MANUAL_SIVO.pdf')
        );
    })->name('sistema.manual');

    Route::get('/teste', [App\Http\Controllers\LaudoController::class, 'verificaCid'])->name('teste.index');
});
