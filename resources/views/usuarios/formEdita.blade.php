<div class="row">
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="name">Nome do usuário</label><span class="text-danger"> *</span>
            <div class="position-relative">
                <input type="text" id="name" class="form-control" placeholder="Nome do usuário" name="name" value="{{ $info->name ?? '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="name">CPF</label><span class="text-danger"> *</span>
            <div class="position-relative">
                <input type="text" id="cpf" class="form-control" placeholder="Informe seu CPF" name="cpf" value="{{ $info->cpf ?? '' }}" {{ $info->cpf != null ? "disabled": "" }}>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="username">Login do usuário</label><span class="text-danger"> *</span>
            
            <div class="position-relative">
                <input type="text" id="username" disabled class="form-control" placeholder="Login do usuário" name="username" value="{{ $info->username ?? '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group has-icon-left">
            <label for="email">Email</label><span class="text-danger"> *</span>
            
            <div class="position-relative">
                <input type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{ $info->email ?? '' }}">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="company-column">Permissões</label>
            <div class="form-group">
                <select class="choices form-select" id="roles" name="roles" >
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"@if (isset($roles_ids) && in_array($role->id, $roles_ids)) {{ 'selected' }} @endif>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-12 {{ isset($info->crm) ? 'd-block' : 'd-none' }}" id="crm-field">
        <div class="form-group has-icon-left">
            <label for="crm">CRM do Médico</label>
            
            <div class="position-relative">
                <input type="text" id="crm" class="form-control" placeholder="Informe o CRM do médico" name="crm" value="{{ $info->crm }}" {{ !isset($info->crm) ? 'disabled' : '' }}>

                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>


</div>
