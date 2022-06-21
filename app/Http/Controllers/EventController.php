<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event; //Aqui estamos chamando nosso model criado, que se chama Event

use App\Models\User;


class EventController extends Controller
{

    public function index(){
        //O search abaixo é a parte de busca do nosso site, é aqui que conseguimos fazer a lógica da busca
        $search = request('search'); 

        if($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        } else {
            $events = Event::all(); //Aqui estamos com o all estamos chamando todos os eventos do meu DB
        }
    
        return view('welcome', ['events' => $events, 'search' => $search]); //Aqui passamos pra view
        
    }
    
    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items; 
        /*Esse request feito acima para item é para ter possibilidade de salvar os itens no DB com a estrutura de json*/

        //Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; 
            /*Acima pegamos o nome do arquivo e concatenamos com o tempo de agora, então cria uma string única baseada no tempo que eu tô dando upload e também coloco no md5 pra fazer uma rash... e depois concatenamos com a extenssão do arquivo, que vai ser a forma que salvo no path */

            $requestImage->move(public_path('img/events'), $imageName); /*aqui estou salvando a imagem no servidor, criamos uma pasta events dentro da img para poder botar as imagens do evento pra não misturar com as outras imagens*/

            $event->image = $imageName;/*Alterei do nosso objeto a propriedade image que estamos instanciando para o imageName que é o nome da imagem, ou seja, aqui que salva no DB de fato*/

        }

        $user = auth()->user();
        $event->user_id = $user->id; /*Estou acessando a propriedade id do usuario logado, e com isso consigo preencher o campo de user_id na tabela events*/

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso'); //Aqui botamos a menssagem que queremos que aparece assim que clicar em criar evento
    }

    public function show($id) {

        $event = Event::findOrFail($id); //Aqui teremos a view resgatada que o cliente solicitou... e percebemos que chamamos também a classe Event, pois estamos utilizando esse model

        $user = auth()->user();
        $hasUserJoined = false; //Se o usuário já marcou presença no evento

        /* Abaixo vamos dar uma checada para saber se tem outro usuario logado, porque pode ser que o auth falhe pois temos a opção de entrar como visitante */
        if($user) {
            
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) { /*lebrando que o $id é o id do evento que vem lá do request e o ['id'] está vindo dos eventos que o usuário participa quem vem da propriedade eventsAsParticipant */
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray(); /*Aqui é para pegar o nome do proprietário do evento*/

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard() {

        $user = auth()->user();
        
        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', 
            ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]); /*Para imprimir a quantidade de participantes do evento*/ 
    }

    public function destroy($id) {
        
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!');
    } /*Action para deletar um evento*/

    public function edit($id) {

        $user = auth()->user();
       
        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {
            return redirect('/dashboard')->with('msg', 'Você não pode editar esse evento.'); /*Aqui é uma validação de segurança para que somente o criador do evento consiga edita-lo*/
        }

        return view('events.edit', ['event' => $event]); 

    } /* Para edição de um evento*/

    public function update(Request $request) {

        //Abaixo é para fazer o upload corretamente de imagens quando editar um evento e mudar sua imagem
        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; 

            $requestImage->move(public_path('img/events'), $imageName); 

            $data['image'] = $imageName;

        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }

    public function joinEvent($id) {

        $user = auth()->user(); //Pegando usuario autenticado

        $user->eventsAsParticipant()->attach($id); /*eventAsParticipant é o metodo criado no model e attach vai inserir o id do evento no id do usuario para aquele método e preencher aquela coluna na tabela com os dados corretos, com os dados dos usuarios e dados do evento*/

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);
    }

    public function leaveEvent($id) {
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id); /*diferente do attach o datach remove a ligação*/

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento: ' . $event->title);
    }

}
