{{-- <input type="hidden" name="id" value="{{ $info->id }}">
<div class="row">
    <div class="col-12">
        <div class="form-group has-icon-left">
            <label for="name">Nome do papél</label>
            <div class="position-relative">
                <input type="text" id="name" class="form-control" placeholder="Nome do papél" name="name" value="{{ $info->name ?? '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="company-column">Permissões</label>
            <div class="form-group">
                <select class="choices form-select multiple-remove" name="permissions[]" multiple="multiple">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}"@if (isset($permissoes_ids) && in_array($permission->id, $permissoes_ids)) {{ 'selected' }} @endif>
                            {{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
            
</div> --}}

<style>
    li {
        list-style-type: none;
    }
</style>

<input type="hidden" name="id" value="{{ $info->id }}"> 

    <h4 class="card-title mb-3">Permissões do papel</h4>
    <p class="text-subtitle text-muted">Gerenciamento de permissões do papel, marque ou desmarque uma permissão</p>
    <div class="row">
        @foreach ($secoes as $secao)
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body" style="min-height: 200px;">
                            <h4 class="card-title">{{ ucfirst($secao['name']) }}</h4>
                            <ul class="p-0">
                                @foreach ($secao['permissoes'] as $permissao)
                                    {{-- {{ dd($permissao); }} --}}
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="form-check-input form-check-primary"
                                                name="permissions[]"
                                                id="{{ $secao['name'] . '-' . $permissao['name'] }}"
                                                value="{{ $permissao['id'] }}"
                                                @if (isset($permissoes_ids) && in_array($permissao['id'], $permissoes_ids)) {{ 'checked' }} @endif
                                                >
                                            <label class="form-check-label"
                                                for="{{ $permissao['name'] }}">{{ $permissao['name'] }}</label>
                                            <i class="bi bi-info-circle-fill" title="{{ $permissao['descricao'] }}" data-bs-toggle="tooltip" data-bs-placement="right"></i>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

