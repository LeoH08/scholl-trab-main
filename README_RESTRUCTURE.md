# Reorganização do Projeto

## TL;DR (Consulta Rápida)

- Pasta duplicada `tcc` eliminada (restou só documentação).
- Zero arquivos `.php` em `tcc/`.
- Toda evolução de código: branches `feature/*`, `fix/*`, `chore/*`.
- Auditoria: `find tcc -type f -iname "*.php"` deve retornar vazio.
- Política aceita e consolidada.

## 1. Contexto

A pasta `tcc` duplicava praticamente toda a base de código (app, public, vendor, etc.), criando risco de divergência e manutenção difícil.

## 2. Decisão

Código-fonte oficial permanece somente na raiz. A pasta `tcc/`:

- OU é removida completamente.
- OU existe apenas para documentação (docs, diagrams, references) sem nenhum `.php`.

## 3. Estrutura Final Recomendada

```
/
  app/
  public/
  vendor/
  config/            (se necessário)
  storage/           (logs / cache - opcional)
  composer.json
  composer.lock
  .env.example
  .env               (gitignore)
  README.md
  README_RESTRUCTURE.md
  tcc/               (opcional – só documentação)
    docs/
    diagrams/
    references/
    README.md
```

## 3.1 Estado Atual (Após Limpeza)

```
/
  app/
  public/
  vendor/
  config/
  storage/              (se aplicável)
  composer.json
  composer.lock
  .env.example
  .env                  (gitignored)
  README.md
  README_RESTRUCTURE.md
  tcc/
    docs/
    diagrams/
    references/
    README.md
```

Nenhum arquivo .php dentro de tcc/. Apenas documentação.

## 4. Checklist de Migração (Concluído)

[x] Backup da pasta `tcc` (zip)  
[x] diff: identificar diferenças reais  
[x] mover arquivos únicos (PDF, diagramas) para `tcc/docs` / `tcc/diagrams` / `tcc/references`  
[x] verificar se havia .php mais novo em `tcc` e aplicar na raiz (nenhuma divergência pendente)  
[x] remover `tcc/app`, `tcc/public`, `tcc/vendor`, `tcc/config`  
[x] recriar somente: `tcc/docs tcc/diagrams tcc/references`  
[x] composer validate / dump-autoload -o  
[x] testar aplicação (rota inicial / login)  
[x] commit: remoção + mensagem clara  
[x] criar tag (se necessário)

## 4.1 Resumo Curto da Decisão (Uso Futuro)

A pasta duplicada foi eliminada. tcc/ existe somente para documentação textual e ativos não-executáveis. Política: nenhum desenvolvimento ou código PHP dentro de tcc/. Alterações de código seguem fluxo normal de branches e PRs.

## 4.2 Workflow Padrão

Branches:

- feature/nome-curto
- fix/descricao-bug
- chore/tarefa-infra
  Commits (convenção):
- feat: adicionar X
- fix: corrigir Y
- chore: manutenção / infra
- docs: atualização somente textual
  Merge: via PR com revisão (evitar commits diretos em main).

## 4.3 Auditoria Automatizada (Exemplo)

Script simples (Linux) para pipeline/CI:

```
if find tcc -type f -iname "*.php" | grep . ; then
  echo "Erro: Arquivos PHP encontrados em tcc/"
  exit 1
fi
echo "OK: tcc/ somente documental."
```

## 5. Comandos de Apoio

### Linux / WSL

```
# Diferenças (ignorando vendor)
diff -qr ./ tcc | grep -v vendor

# Listar PHP restantes em tcc
find tcc -type f -iname "*.php"

# Backup
zip -r backup-tcc.zip tcc

# Remover diretórios duplicados (após validar)
rm -rf tcc/app tcc/public tcc/vendor tcc/config

# Recriar pastas só de docs
mkdir -p tcc/docs tcc/diagrams tcc/references
```

### Windows (PowerShell)

```
# Backup
Compress-Archive -Path tcc -DestinationPath backup-tcc.zip

# Diferenças básicas (nomes)
Get-ChildItem -Recurse tcc -Include *.php | Select FullName

# Remover diretórios duplicados
Remove-Item -Recurse -Force tcc\app, tcc\public, tcc\vendor, tcc\config -ErrorAction SilentlyContinue

# Recriar estrutura documental
New-Item -ItemType Directory -Force -Path tcc\docs, tcc\diagrams, tcc\references | Out-Null
```

### Composer / Verificação

```
composer validate
composer dump-autoload -o
```

## 6. Opção: Remover Totalmente `tcc`

Se não precisa de documentação agora:

```
rm -rf tcc                # ou Remove-Item -Recurse -Force tcc
git add -u
git commit -m "chore: remove duplicated tcc directory"
```

## 7. Commits Exemplos

```
# Remoção simples
git add -u
git commit -m "chore: remove duplicated tcc directory (unify codebase)"

# Caso tenha trazido um model atualizado de tcc
git commit -m "fix: merge updated AlunoModel from tcc duplication"

# Criar tag para anexar no TCC
git tag v1.0-tcc
git archive -o release-v1.0-tcc.zip v1.0-tcc
```

## 8. Boas Práticas Futuras

- Nunca desenvolver dentro de `tcc/`.
- Referenciar trechos de código no relatório copiando apenas fragmentos.
- Criar branches (feature/\*) em vez de duplicar diretórios.
- Auditoria ocasional: `find . -path "*tcc/*" -name "*.php"` (deve retornar vazio).
  Adicionar:
- Prefixar diagramas: `arq-`, `seq-`, `case-`.
- Nomear PDFs referência: `ref-<autor>-<ano>-<tema>.pdf`.

## 9. FAQ

Q: Posso excluir `tcc` agora?  
A: Sim, após backup e verificação de diferenças.

Q: Orientador quer o código junto?  
A: Entregue um zip gerado via tag (release), não uma pasta interna duplicada.

Q: E se algo em `tcc` estava mais novo?  
A: Aplique manualmente na raiz e registre em commit separado (tipo fix: ...).

Q: Por que não manter duas bases?  
A: Divergência silenciosa, risco de merge incorreto, tempo extra de manutenção.

Q: "pq tem as pastas tudo e o clone que é o tcc?"  
A: Antes a pasta `tcc/` era um espelho (cópia) completo do código (app, public, vendor, etc.) criada para fins acadêmicos / TCC. Isso gerava duas árvores de código com risco de versões diferentes. A limpeza consolidou tudo na raiz; `tcc/` agora só pode (1) existir como documentação (docs/diagrams/references) sem nenhum `.php`, ou (2) ser removida totalmente.  
Se após um clone você ainda vê código PHP dentro de `tcc/`, provavelmente está em um commit antigo ou branch desatualizada. Atualize:  
 git pull origin main  
 (ou) git fetch --all --prune  
 git checkout main  
Verifique:  
 find tcc -type f -iname "\*.php" (deve não retornar nada).  
Se não precisa de documentação, pode remover a pasta:  
 rm -rf tcc && git add -u && git commit -m "chore: remove legacy tcc folder"

## 10. Pós-Limpeza (Opcional)

(Substituído pelo resumo curto acima; seção mantida por histórico.)

## 11. Próxima Redução (Sugestão)

Quando estável: manter apenas seções TL;DR, Workflow Padrão e Auditoria; arquivar versão completa via tag.

---

(Status: Limpeza concluída e estrutura unificada. Documento atualizado com workflow e auditoria.)
