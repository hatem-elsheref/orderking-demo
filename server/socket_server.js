const http = require('http');
const socketIO = require('socket.io');
const redis = require('redis');

const server = http.createServer();

const io = socketIO(server, {
    cors: {
        origin: "*",
        methods: "*",
    }
});

const main = async () => {
    // Creating a redis client
    const redisClientPub = redis.createClient();
    await redisClientPub.connect();

    // creating a redis subscriber
    const redisClientSub = redisClientPub.duplicate();
    await redisClientSub.connect();

    await redisClientSub.subscribe('customer.approved', (message) => {
        let data = JSON.parse(message);
        io.emit(`customer.${data.data.data.customer}.approved`, { status: true });
    });

    await redisClientSub.subscribe('customer.registered', (message) => {
        io.emit(`new.customer`, { status: true });
    });

    io.on("connection",  (socket) => {
        socket.on("customer.approve", async (message) => {
            await redisClientPub.publish('customer.approving', message);
        });

        socket.on('disconnect', () => {
            console.log('Client disconnected');
        });

    });

    server.listen(5000, () => {
        console.log("Server is running");
    });
};

main();
