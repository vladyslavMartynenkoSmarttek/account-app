//create page for chat
export default function Chat() {
    const [messages, setMessages] = useState([]);
    const [input, setInput] = useState("");

    //get messages from db
    useEffect(() => {
        db.collection("messages")
            .orderBy("timestamp", "asc")
            .onSnapshot((snapshot) => {
                //set messages to the messages in the db
                setMessages(snapshot.docs.map((doc) => doc.data()));
            });
    }, []);

    //send message to db
    const sendMessage = (e) => {
        e.preventDefault();
        //add message to db
        db.collection("messages").add({
            message: input,
            username: "test",
            timestamp: firebase.firestore.FieldValue.serverTimestamp(),
        });
        //set input to empty string
        setInput("");
    };

    return (
        <div className="chat">
            <div className="chat__header">
                <Avatar/>
                <div className="chat__headerInfo">
                    <h3>Room Name</h3>
                    <p>Last seen at ...</p>
                </div>
                <div className="chat__headerRight">
                    <IconButton>
                        <SearchOutlinedIcon className="chat__headerRightIcon"/>
                    </IconButton>
                    <IconButton>
                        <AttachFileOutlinedIcon className="chat__headerRightIcon"/>
                    </IconButton>
                    <IconButton>
                        <MoreVertOutlinedIcon className="chat__headerRightIcon"/>
                    </IconButton>
                </div>
            </div>
            <div className="chat__body">
                {messages.map((message) => (
                    <p
                        className={`chat__message ${
                            message.username === "test" && "chat__reciever"
                        }`}
                    >
                        <span className="chat__name">{message.username}</span>
                        {message.message}
                        <span className="chat__timestamp">
              {new Date(message.timestamp?.toDate()).toLocaleTimeString()}
            </span>
                    </p>
                ))}
            </div>
            <div className="chat__footer">
                <IconButton>
                    <InsertEmoticonOutlinedIcon className="chat__footerIcon"/>
                </IconButton>
                <form>
                    <input
                        value={input}
                        onChange={(e) => setInput(e.target.value)}
                        type="text"
                        placeholder="Type a message"
                    />
                    <button onClick={sendMessage} type="submit">
                        Send a message
                    </button>
                </ form>
                <IconButton>
                    <MicOutlinedIcon className="chat__footerIcon"/>
                </IconButton>
            </div>
        </div>
    );
}
