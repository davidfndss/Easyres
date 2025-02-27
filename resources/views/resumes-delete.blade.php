<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Easyres') }}</title>
    <!-- Vite CSS -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-zinc-950">
    <section class="min-w-screen min-h-screen flex flex-col justify-start items-center">
        <h1 class="text-4xl font-bold text-emerald-500 mt-[20vh]">
            Apagar Currículo:
        </h1>
        
        <form id="delete-resume-form" class="flex flex-col rounded border-zinc-900 p-6 mt-2 gap-2 text-zinc-100">
            @csrf
            <div class="flex flex-col max-w-[300px]">
                <p class="text-zinc-600">Nome: </p>
                <h2 class="text-2xl text-zinc-100 tracking-tight" id="name" name="name"></h2>
            </div>
            <div class="max-w-[300px] hidden">
                <h2 class="rounded-full mt-1 bg-zinc-900 px-3" id="worked_at" name="worked_at"></h2>
            </div>
            <p class="-mb-2 text-zinc-500">Já trabalhou em: </p>
            <div id="xp-added-area" class="mt-2 gap-1 flex flex-wrap max-w-[300px]">
                <!-- Generated by <script> -->
            </div>

            <button type="submit" class="mt-2 bg-red-700 text-zinc-100 font-[600] max-w-[300px] tracking-tight rounded-full text-xl py-1 px-4">Apagar</button>

            <div id="response-message" class="mt-2"></div>
        </form>
    </section>

    <script>
        const addxpbtn = document.getElementById("add-xp-btn")
        const workedatinput = document.getElementById("worked_at")
        const xpArray = []
        const xpAddedArea =  document.getElementById("xp-added-area") 
        const id = "{{ $id }}"

        fetch(`http://127.0.0.1:8000/api/resume/${id}`)
            .then(response => response.json())
            .then(data => {
                const workedAtArray = JSON.parse(data.data.worked_at)
                document.getElementById('name').innerText = data.data.name

                if (workedAtArray.length > 0 ) {
                    workedAtArray.forEach(xp => {
                        xpArray.push(xp)
                        const xpDivToAppend = document.createElement("div")
                        xpDivToAppend.classList.add('px-6', 'py-1', 'rounded-full', 'bg-zinc-900')
                        xpDivToAppend.innerText = xp
                        
                        xpDivToAppend.addEventListener('click', () => {
                            xpArray.splice(xpArray.indexOf(xp), 1)
                            updateXpAddedArea()
                        })
                        
                        xpAddedArea.append(xpDivToAppend)
                    })
                }
            })
            .catch(error => console.error('Erro ao buscar resumes:', error));

        document.getElementById('delete-resume-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            try {
                let response = await fetch(`{{ url('/api/resume/') }}/${id}/delete?password=123456`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                });

                let result = await response.json();

                if (response.ok) {
                    document.getElementById('response-message').innerHTML = `<p style="color:green;">${result.message}</p>`;
                } else {
                    document.getElementById('response-message').innerHTML = `<p style="color:red;">${JSON.stringify(result.errors)}</p>`;
                }
            } catch (error) {
                console.error("Erro:", error);
            }
        });
    </script>
</body>
</html>